<?php

class UsersTable extends Database
{
    static public function getUsers() : array
    {
        self::$statement = self::$pdo->query('SELECT users.user_id, users.username, users.firstname, users.lastname, roles.name as role_name FROM users LEFT JOIN roles ON users.role_id = roles.role_id');
        
        return self::$statement->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    static public function createUser(array $properties) : void
    {
        self::$statement = self::$pdo->prepare('INSERT INTO users (users.username, users.pwd, users.firstname, users.lastname, users.role_id) VALUES (:username, :pwd, :firstname, :lastname, :role_id)');
        
        $pwd_hashed = password_hash(hash_hmac("sha256", $properties['password'], APP_SECRET), PASSWORD_DEFAULT);

        self::$statement->bindParam(':username', $properties['username']);
        self::$statement->bindParam(':pwd', $pwd_hashed);
        self::$statement->bindParam(':firstname', $properties['firstname']);
        self::$statement->bindParam(':lastname', $properties['lastname']);
        self::$statement->bindParam(':role_id', $properties['roleId']);

        self::$statement->execute();
    }

    static function updateUser(array $properties) : void
    {
        self::$statement = self::$pdo->prepare('UPDATE users SET users.username = :username, users.firstname = :firstname, users.lastname = :lastname, users.role_id = :role_id WHERE users.user_id = :user_id');
        
        self::$statement->bindParam(':user_id', $properties['userId']);
        self::$statement->bindParam(':username', $properties['username']);
        self::$statement->bindParam(':firstname', $properties['firstname']);
        self::$statement->bindParam(':lastname', $properties['lastname']);
        self::$statement->bindParam(':role_id', $properties['roleId']);

        self::$statement->execute();
    }

    static function deleteUser(int $userId) : void
    {
        self::$statement = self::$pdo->prepare('DELETE FROM users WHERE users.user_id = :user_id');
        
        self::$statement->bindParam(':user_id', $userId);

        self::$statement->execute();
    }

    static function isUserAlreadyRegistered(array $properties) 
    {
        self::$statement = self::$pdo->prepare('SELECT users.user_id FROM users WHERE users.username = :username AND users.firstname = :firstname AND users.lastname = :lastname AND users.role_id = :role_id');

        self::$statement->bindParam(':username', $properties['username']);
        self::$statement->bindParam(':firstname', $properties['firstname']);
        self::$statement->bindParam(':lastname', $properties['lastname']);
        self::$statement->bindParam(':role_id', $properties['roleId']);

        self::$statement->execute();
    
        $result = self::$statement->fetch();
        return !empty($result);
    }
}