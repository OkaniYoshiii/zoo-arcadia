<?php

namespace App\Models\Table;

use App\Entity\User;
use App\Interface\EntityInterface;
use App\Trait\TableTrait;
use Database;
use PDO;

class UsersTable
{
    const TABLE_NAME = 'users';
    const ENTITY = ['name' => 'User', 'class' => User::class];
    const PRIMARY_KEY = 'user_id';

    use TableTrait;

    public static function create(User $user) : void
    {
        self::checkConstantsDeclaration();

        $sql = 'INSERT INTO users (users.username, users.firstname, users.lastname, users.pwd, users.role_id) VALUES (:username, :firstname, :lastname, :pwd, :role_id)';
        Database::$statement = Database::$pdo->prepare($sql);
        
        $username = $user->getUsername();
        $firstname = $user->getFirstname();
        $lastname = $user->getLastname();
        $pwd = $user->getPassword();
        $role_id = $user->getRoleId();

        $pwd = password_hash(self::getPepperedPassword($pwd), PASSWORD_DEFAULT);

        Database::$statement->bindValue(':username', $username);
        Database::$statement->bindValue(':firstname', $firstname);
        Database::$statement->bindValue(':lastname', $lastname);
        Database::$statement->bindValue(':pwd', $pwd);
        Database::$statement->bindValue(':role_id', $role_id);

        Database::$statement->execute();
    }

    public static function isAlreadyRegistered(User $user) : bool 
    {
        self::checkConstantsDeclaration();

        $sql = 'SELECT users.username, users.pwd FROM users WHERE users.username = :username';
        Database::$statement = Database::$pdo->prepare($sql);

        $username = $user->getUsername();
        $pwd = $user->getPassword();
        Database::$statement->bindValue(':username', $username);

        Database::$statement->execute();
        $result = Database::$statement->fetch(PDO::FETCH_ASSOC);

        return ($result) ? password_verify(self::getPepperedPassword($pwd), $result['pwd']) : false;
    }

    public static function getPepperedPassword(string $pwd) : string
    {
        return hash_hmac("sha256", $pwd, APP_SECRET);
    }
}