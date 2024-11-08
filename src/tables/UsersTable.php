<?php

namespace App\Models\Table;

use App\Entity\Role;
use App\Entity\User;
use App\Interface\EntityInterface;
use App\Trait\TableTrait;
use Database;
use Exception;
use PDO;

class UsersTable
{
    const TABLE_NAME = 'users';
    const ENTITY = ['name' => 'User', 'class' => User::class];
    const PRIMARY_KEY = 'user_id';

    use TableTrait;

    public static function getAllWithJoins() : array
    {
        $joins = [
            [
                'table' => RolesTable::class,
                'fields' => [
                    RolesTable::PRIMARY_KEY,
                    'name',
                ]
            ],
        ];

        $sqlJoins = [];

        $sqlFields = array_map(function($field) {
            return self::TABLE_NAME . '.' . $field . ' AS ' . self::ENTITY['name'] . '_' . $field;
        }, ['user_id', 'username', 'firstname', 'lastname', 'role_id']);
        
        foreach($joins as $join)
        {
            $table = $join['table'];
            $fields = $join['fields'];

            if(!in_array(TableTrait::class, class_uses($table))) throw new Exception('Argument [0] (array $joinedTablesClasses) contains ' . $table . ' which need to use the trait ' . TableTrait::class . ' to be joined in the query.');
            $sqlJoin = 'JOIN ' . $table::TABLE_NAME;
            $sqlJoin .= ' ON ' . self::TABLE_NAME . '.' . $table::PRIMARY_KEY;
            $sqlJoin .= ' = ' . $table::TABLE_NAME . '.' . $table::PRIMARY_KEY;

            foreach($fields as $field)
            {
                $sqlFields[] = $table::TABLE_NAME . '.' . $field . ' AS ' . $table::ENTITY['name'] . '_' . $field;
            }

            $sqlJoins[] = $sqlJoin;
        }
        $sql = 'SELECT ' . implode(', ', $sqlFields) . ' FROM ' . self::TABLE_NAME . ' ' . implode(' ', $sqlJoins);
        Database::$statement = Database::$pdo->query($sql);

        $users = [];
        while($row = Database::$statement->fetch(PDO::FETCH_ASSOC))
        {
            $userId = $row[self::ENTITY['name'] . '_' . self::PRIMARY_KEY];
            foreach($row as $field => $value)
            {
                if(str_contains($field, self::ENTITY['name'] . '_')) {
                    $field = str_replace(self::ENTITY['name'] . '_', '', $field);
                    $users[$userId][$field] = $value;
                }

                if(str_contains($field, RolesTable::ENTITY['name'] . '_')) {
                    $field = str_replace(RolesTable::ENTITY['name'] . '_', '', $field);
                    $users[$userId]['role'][$field] = $value;
                }
            }
        }

        $users = array_map(function($user) {
            $user['role'] = new Role($user['role']);
            return new User($user);
        }, $users);

        return $users;
    }

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

    public static function update(User $user) : void 
    {
        self::checkConstantsDeclaration();

        $sql = 'UPDATE users SET username = :username, firstname = :firstname, lastname = :lastname, pwd = :pwd, role_id = :role_id WHERE users.user_id = :user_id';
        Database::$statement = Database::$pdo->prepare($sql);
        
        $user_id = $user->getUserId();
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
        Database::$statement->bindValue(':user_id', $user_id);
        
        Database::$statement->execute();
    }

    public static function isAlreadyRegistered(User $user) : EntityInterface|false 
    {
        self::checkConstantsDeclaration();

        $sql = 'SELECT users.role_id, users.username, users.pwd FROM users WHERE users.username = :username';
        Database::$statement = Database::$pdo->prepare($sql);

        $username = $user->getUsername();
        $pwd = $user->getPassword();
        Database::$statement->bindValue(':username', $username);

        Database::$statement->execute();
        $result = Database::$statement->fetch(PDO::FETCH_ASSOC);
        
        if(!boolval($result)) return false;
        if(!password_verify(self::getPepperedPassword($pwd), $result['pwd'])) return false;
        return new User($result);
    }

    private static function getPepperedPassword(string $pwd) : string
    {
        return hash_hmac("sha256", $pwd, $_ENV['APP_SECRET']);
    }
}