<?php

namespace App\Trait;

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

        $fields = implode(', ', array_map(function($property) { return self::TABLE_NAME . $property; }, $entity::getClassProperties()));
        $parameters = implode(', ', array_map(function($property) { return ':' . $property; }, $entity::getClassProperties()));

        $sql = 'INSERT INTO ' . self::TABLE_NAME . $fields . ' VALUES ' . $parameters;
        Database::$statement = Database::$pdo->prepare($sql);
        
        foreach($entity::getClassProperties() as $property)
        {
            $entityGetter = 'get' . str_replace('_', '', ucwords($property,'_'));
            Database::$statement->bindParam(':' . $property, $entity->$entityGetter());
        }

        Database::$statement->execute();
    }

    public static function update(EntityInterface $entity) : void 
    {
        self::checkConstantsDeclaration();

        $set = implode(', ',array_map( function($property) { return $property . ' = :' . $property; }, $entity::getClassProperties()));
        $sql = 'UPDATE ' . self::TABLE_NAME . ' SET ' . $set;
        Database::$statement = Database::$pdo->prepare($sql);
        
        foreach($entity::getClassProperties() as $property)
        {
            $entityGetter = 'get' . str_replace('_', '', ucwords($property,'_'));
            Database::$statement->bindParam(':' . $property, $entity->$entityGetter());
        }

        Database::$statement->execute();
    }

    public static function delete(int $id) : void 
    {
        self::checkConstantsDeclaration();

        $sql = 'DELETE FROM ' . self::TABLE_NAME . ' WHERE ' . '.' . $id . ' = :id';
        Database::$statement = Database::$pdo->prepare($sql);
        
        Database::$statement->bindParam(':id', $id, PDO::PARAM_INT);

        Database::$statement->execute();
    }

    public static function isAlreadyRegistered(EntityInterface $entity) : bool 
    {
        self::checkConstantsDeclaration();

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
        self::$hasConstantsDefined = true;
    }
}