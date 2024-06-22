<?php

class RolesTable extends Database
{
    public static function getRoles() : array
    {
        self::$statement = self::$pdo->query('SELECT roles.role_id, roles.name FROM roles');
        
        return self::$statement->fetchAll(PDO::FETCH_CLASS, 'Role');
    }
}