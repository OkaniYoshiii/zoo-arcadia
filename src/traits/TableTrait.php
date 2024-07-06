<?php

namespace App\Trait;

use App\Entity\User;
use App\Interface\EntityInterface;
use Database;
use Exception;
use PDO;

trait TableTrait
{
    private static bool $hasConstantsDefined = false;
    public static function getAll() : array|false
    {
        self::checkConstantsDeclaration();

        Database::$statement = Database::$pdo->query('SELECT * FROM ' . self::TABLE_NAME);
        return Database::$statement->fetchAll(PDO::FETCH_CLASS, self::ENTITY['class']);
    }

    public static function create(EntityInterface $entity) : void
    {
        self::checkConstantsDeclaration();

        $fields = implode(', ', array_map(function($property) { return self::TABLE_NAME . '.' . $property; }, array_keys($entity->getObjectVars())));
        $parameters = implode(', ', array_map(function($property) { return ':' . $property; }, array_keys($entity->getObjectVars())));

        $sql = 'INSERT INTO ' . self::TABLE_NAME . ' (' . $fields . ') VALUES (' . $parameters . ')';
        Database::$statement = Database::$pdo->prepare($sql);
        
        foreach($entity->getObjectVars() as $name => $value)
        {
            if($entity::class === User::class) {
                if($name === 'pwd' || $name === 'password') {
                    $value = password_hash(hash_hmac("sha256", $value, APP_SECRET), PASSWORD_DEFAULT);
                } 
            }
            Database::$statement->bindValue($name, $value);
        }

        Database::$statement->execute();
    }

    public static function update(EntityInterface $entity) : void 
    {
        self::checkConstantsDeclaration();

        $set = implode(', ',array_map( function($property) { return $property . ' = :' . $property; }, $entity->getObjectVars()));
        $sql = 'UPDATE ' . self::TABLE_NAME . ' SET ' . $set;
        Database::$statement = Database::$pdo->prepare($sql);
        
        foreach($entity->getObjectVars() as $property)
        {
            $entityGetter = 'get' . str_replace('_', '', ucwords($property,'_'));
            Database::$statement->bindValue(':' . $property, $entity->$entityGetter());
        }

        Database::$statement->execute();
    }

    public static function delete(int $id) : void 
    {
        self::checkConstantsDeclaration();

        $sql = 'DELETE FROM ' . self::TABLE_NAME . ' WHERE ' . '.' . $id . ' = :id';
        Database::$statement = Database::$pdo->prepare($sql);
        
        Database::$statement->bindValue(':id', $id, PDO::PARAM_INT);

        Database::$statement->execute();
    }

    public static function isAlreadyRegistered(EntityInterface $entity) : bool 
    {
        self::checkConstantsDeclaration();

        $where = implode(' AND ',array_map( function($property) { return self::TABLE_NAME . '.' . $property . ' = :' . $property; }, array_keys($entity->getObjectVars())));
        $sql = 'SELECT ' . self::PRIMARY_KEY . ' FROM ' . self::TABLE_NAME . ' WHERE ' . $where;
        var_dump($sql);
        Database::$statement = Database::$pdo->prepare($sql);

        foreach($entity->getObjectVars() as $name => $value)
        {
            if($entity::class === User::class) {
                if($name === 'pwd' || $name === 'password') {
                    $value = password_hash(hash_hmac("sha256", $value, APP_SECRET), PASSWORD_DEFAULT);
                } 
            }
            var_dump($name, $value);
            Database::$statement->bindValue(':' . $name, $value);
        }

        Database::$statement->execute();
        $result = Database::$statement->fetch(PDO::FETCH_ASSOC);
        var_dump($result);
        return false;
    }

    public static function truncate() : void
    {
        self::checkConstantsDeclaration();

        Database::$pdo->query('TRUNCATE TABLE ' . self::TABLE_NAME());
    }

    private static function checkConstantsDeclaration() : void
    {
        if(self::$hasConstantsDefined) return;

        if(!defined(self::class . '::TABLE_NAME')) throw new Exception(self::class . ' need to have a TABLE_NAME constant defined. This constant has to be a string and must have the name of the related table in the database as value.');
        if(!is_string(self::TABLE_NAME)) throw new Exception('TABLE_NAME constant of ' . self::class . ' has to be a string and must have the name of the related table in the database as value.');
        if(!defined(self::class . '::ENTITY')) throw new Exception(self::class . ' need to have a ENTITY constant defined. This constant has to be an array with two keys : \'name\' and \'class\' (e.g : const ENTITY = [\'name\' => \'Product\', \'class\' => Product::class ]');
        if(!is_array(self::ENTITY)) throw new Exception('ENTITY constant of ' . self::class . ' has to be an array with two keys : \'name\' (name of the entity), \'class\' (classname of the entity obtained with \'nameOfYourClass::class\')');
        if(!in_array('name', array_keys(self::ENTITY))) throw new Exception('ENTITY constant of ' . self::class . ' doesn\'t have a \'name\' key. It\'s value must be the name of the entity related to the table class.');
        if(!in_array('class', array_keys(self::ENTITY))) throw new Exception('ENTITY constant of ' . self::class . ' doesn\'t have a \'class\' key. It\'s value must be the class name of the entity related to the table (obtained with \'nameOfYourClass::class\')');
        if(!defined(self::class . '::PRIMARY_KEY')) throw new Exception(self::class . ' need to have a PRIMARY_KEY constant defined. This constant has to be a string and must have the name of the related table primary key as value.');
        if(!is_string(self::PRIMARY_KEY)) throw new Exception('PRIMARY_KEY constant of ' . self::class . ' has to be a string and must have the name of the related table primary key as value.');
        self::$hasConstantsDefined = true;
    }
}