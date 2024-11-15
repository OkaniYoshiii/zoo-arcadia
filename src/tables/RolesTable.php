<?php

namespace App\Tables;

use App\Database;
use App\Entities\Role;
use App\Traits\TableTrait;
use PDO;

class RolesTable
{
    const TABLE_NAME = 'roles';
    const ENTITY = ['name' => 'Role', 'class' => Role::class];
    const PRIMARY_KEY = 'role_id';

    use TableTrait;

    public static function findById(int $role_id) : Role
    {
        Database::$statement = Database::$pdo->prepare('SELECT * FROM roles WHERE role_id = :role_id');

        Database::$statement->bindValue(':role_id', $role_id);

        Database::$statement->setFetchMode(PDO::FETCH_CLASS, Role::class);
        Database::$statement->execute();
        return Database::$statement->fetch();
    }
}