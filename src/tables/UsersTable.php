<?php

namespace App\Models\Table;

use App\Entity\User;
use App\Interfaces\Tables\UsersTableInterface;
use Database;
use Exception;
use PDO;

class UsersTable extends Database implements UsersTableInterface
{
    static public function getAll() : array|false
    {
        self::$statement = self::$pdo->query('SELECT users.user_id, users.username, users.firstname, users.lastname, users.role_id FROM users');
        
        return self::$statement->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    static public function create(User $user) : void
    {
        self::$statement = self::$pdo->prepare('INSERT INTO users (`username`, `pwd`, `firstname`, `lastname`, `role_id`) VALUES (:username, :pwd, :firstname, :lastname, :role_id)');
        
        $username = $user->getUsername();
        $password = password_hash(hash_hmac("sha256", $user->getPassword(), APP_SECRET), PASSWORD_DEFAULT);
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $role_id = $user->getRoleId();

        self::$statement->bindParam(':username', $username);
        self::$statement->bindParam(':pwd', $password);
        self::$statement->bindParam(':firstname', $firstname);
        self::$statement->bindParam(':lastname', $lastname);
        self::$statement->bindParam(':role_id', $role_id);

        self::$statement->execute();
    }

    static function update(User $user) : void
    {
        self::$statement = self::$pdo->prepare('UPDATE users SET users.username = :username, users.firstname = :firstname, users.lastname = :lastname, users.role_id = :role_id WHERE users.user_id = :user_id');
        
        $user_id = $user->getUserId();
        $username = $user->getUsername();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $role_id = $user->getRoleId();

        self::$statement->bindParam(':user_id', $user_id);
        self::$statement->bindParam(':username', $username);
        self::$statement->bindParam(':firstname', $firstname);
        self::$statement->bindParam(':lastname', $lastname);
        self::$statement->bindParam(':role_id', $role_id);

        self::$statement->execute();
    }

    static function delete(int $id) : void
    {
        self::$statement = self::$pdo->prepare('DELETE FROM users WHERE user_id = :user_id');
        
        self::$statement->bindParam(':user_id', $id, PDO::PARAM_INT);

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

    static public function getOneBy(string $property, $value): User|false
    {
        if(!property_exists(User::class, $property)) throw new Exception('Property ' . $property . ' does not exist on Entity Animal.');
        self::$statement = self::$pdo->prepare('SELECT * FROM users WHERE ' . $property . ' = :val');
        
        self::$statement->bindParam(':val', $value);

        self::$statement->execute();
        self::$statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        return self::$statement->fetch();
    }
}