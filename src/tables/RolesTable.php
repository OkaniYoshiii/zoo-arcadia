<?php

namespace App\Models\Table;

use App\Entity\Role;
use App\Interfaces\Tables\RolesTableInterface;
use Database;
use Exception;
use PDO;

class RolesTable extends Database implements RolesTableInterface
{
    static public function getAll(array $joins = []) : array|false
    {
        self::$statement = self::$pdo->query('SELECT * FROM roles');
        
        return self::$statement->fetchAll(PDO::FETCH_CLASS, Role::class);
    }

    static public function create(Role $role) : void
    {
        self::$statement = self::$pdo->prepare('INSERT INTO roles (`name`) VALUES (:name)');

        $name = $role->getName();

        self::$statement->bindParam(':name', $name);

        self::$statement->execute();
    }

    static public function update(Role $role) : void
    {

    }

    static public function delete($id) : void
    {

    }

    static public function isAlreadyRegistered(Role $role) : bool
    {
        return false;
    }

    static public function getOneBy(string $property, $value): Role|false
    {
        if(!property_exists(Role::class, $property)) throw new Exception('Property ' . $property . ' does not exist on Entity Animal.');
        self::$statement = self::$pdo->prepare('SELECT * FROM roles WHERE ' . $property . ' = :val');
        
        self::$statement->bindParam(':val', $value);

        self::$statement->execute();
        self::$statement->setFetchMode(PDO::FETCH_CLASS, Role::class);
        return self::$statement->fetch();
    }
}