<?php

namespace App\Models\Table;

use App\Entity\Role;
use App\Interfaces\Tables\RolesTableInterface;
use Database;
use Exception;
use PDO;

class RolesTable extends Database implements RolesTableInterface
{
    static public function getAll() : array
    {
        self::$statement = self::$pdo->query('SELECT roles.role_id, roles.name FROM roles');
        
        return self::$statement->fetchAll(PDO::FETCH_CLASS, 'Role');
    }

    static public function create(Role $role) : void
    {
        echo 'Bien le bonjour';
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

    static public function getOneBy(string $property, $value): Role
    {
        if(!property_exists(Role::class, $property)) throw new Exception('Property ' . $property . ' does not exist on Entity Animal.');
        self::$statement = self::$pdo->prepare('SELECT * FROM roles WHERE :property = :val');
        
        self::$statement->bindParam(':property', $property);
        self::$statement->bindParam(':val', $value);

        self::$statement->execute();
        return self::$statement->fetch(PDO::FETCH_CLASS, Role::class);
    }
}