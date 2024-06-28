<?php

namespace App\Models\Table;

use App\Entity\User;
use App\Interfaces\Tables\UsersTableInterface;
use Database;
use PDO;

class UsersTable extends Database implements UsersTableInterface
{
    static public function getAll() : array
    {
        self::$statement = self::$pdo->query('SELECT users.user_id, users.username, users.firstname, users.lastname, roles.name as role_name FROM users LEFT JOIN roles ON users.role_id = roles.role_id');
        
        return self::$statement->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    static public function create(User $user) : void
    {
        self::$statement = self::$pdo->prepare('INSERT INTO users (users.username, users.pwd, users.firstname, users.lastname, users.role_id) VALUES (:username, :pwd, :firstname, :lastname, :role_id)');
        
        $pwd_hashed = password_hash(hash_hmac("sha256", $user->getPassword(), APP_SECRET), PASSWORD_DEFAULT);

        self::$statement->bindParam(':username', $user->getUsername());
        self::$statement->bindParam(':pwd', $pwd_hashed);
        self::$statement->bindParam(':firstname', $user->getFirstname());
        self::$statement->bindParam(':lastname', $user->getLastname());
        self::$statement->bindParam(':role_id', $user->getRoleId());

        self::$statement->execute();
    }

    static function update(User $user) : void
    {
        self::$statement = self::$pdo->prepare('UPDATE users SET users.username = :username, users.firstname = :firstname, users.lastname = :lastname, users.role_id = :role_id WHERE users.user_id = :user_id');
        
        self::$statement->bindParam(':user_id', $user->getId());
        self::$statement->bindParam(':username', $user->getUsername());
        self::$statement->bindParam(':firstname', $user->getFirstname());
        self::$statement->bindParam(':lastname', $user->getLastname());
        self::$statement->bindParam(':role_id', $user->getRoleId());

        self::$statement->execute();
    }

    static function delete(int $id) : void
    {
        self::$statement = self::$pdo->prepare('DELETE FROM users WHERE users.user_id = :user_id');
        
        self::$statement->bindParam(':user_id', $userId);

        self::$statement->execute();
    }

    static function isAlreadyRegistered(User $user) : bool
    {
        self::$statement = self::$pdo->prepare('SELECT users.user_id FROM users WHERE users.username = :username AND users.firstname = :firstname AND users.lastname = :lastname AND users.role_id = :role_id');

        self::$statement->bindParam(':username', $user->getUsername());
        self::$statement->bindParam(':firstname', $user->getFirstname());
        self::$statement->bindParam(':lastname', $user->getLastname());
        self::$statement->bindParam(':role_id', $user->getRoleId());

        self::$statement->execute();
    
        $result = self::$statement->fetch();
        return !empty($result);
    }
}