<?php

use App\Entity\User;
use App\Exception\FormInputException;
use App\Models\Table\RolesTable;
use App\Models\Table\UsersTable;

class UsersCrudController
{
    private static array $formData;

    public function getVariables() : array
    {
        return [
            'users' => UsersTable::getAllWithJoins(),
            'roles' => RolesTable::getAll(),
        ];
    }

    public function processFormData()
    {
        self::$formData = [
            'user_id' => $_POST['user_id'] ?? null,
            'username' => $_POST['username'] ?? null,
            'firstname' => $_POST['firstname'] ?? null,
            'lastname' => $_POST['lastname'] ?? null,
            'pwd' => $_POST['pwd'] ?? null,
            'role_id' => $_POST['role_id'] ?? null,
        ];

        match($_POST['crudAction']) {
            'CREATE' => self::createUser(),
            'UPDATE' => self::updateUser(),
            'DELETE' => self::deleteUser(),
            default => throw new FormInputException('crudAction', FormInputException::INVALID_CRUD_ACTION),
        };
    }

    private static function createUser()
    {
        if(is_null(self::$formData['username'])) throw new FormInputException('username', FormInputException::UNDEFINED_VALUE);
        if(is_null(self::$formData['firstname'])) throw new FormInputException('firstname', FormInputException::UNDEFINED_VALUE);
        if(is_null(self::$formData['lastname'])) throw new FormInputException('lastname', FormInputException::UNDEFINED_VALUE);
        if(is_null(self::$formData['pwd'])) throw new FormInputException('pwd', FormInputException::UNDEFINED_VALUE);
        if(is_null(self::$formData['role_id'])) throw new FormInputException('role_id', FormInputException::UNDEFINED_VALUE);

        if(empty(self::$formData['username'])) UserAlertsContainer::add('L\'email de l\'utilisateur est vide.');
        if(empty(self::$formData['firstname']))UserAlertsContainer::add('Le nom d\'utilisateur est vide.');
        if(empty(self::$formData['lastname'])) UserAlertsContainer::add('Le nom de famille de l\'utilisateur est vide.');
        if(empty(self::$formData['pwd'])) UserAlertsContainer::add('Le mot de passe de l\'utilisateur est vide.');

        $entity = new User(self::$formData);
        if(UsersTable::isAlreadyRegistered($entity)) UserAlertsContainer::add('L\'utilisateur que vous essayez de créer existe déjà.');

        if(UserAlertsContainer::hasAlerts()) return;

        UsersTable::create($entity);
    }

    private static function updateUser()
    {
        if(empty(self::$formData['user_id']) || is_null(self::$formData['user_id'])) throw new FormInputException('user_id', FormInputException::UNDEFINED_VALUE);
        if(is_null(self::$formData['username'])) throw new FormInputException('username', FormInputException::UNDEFINED_VALUE);
        if(is_null(self::$formData['firstname'])) throw new FormInputException('firstname', FormInputException::UNDEFINED_VALUE);
        if(is_null(self::$formData['lastname'])) throw new FormInputException('lastname', FormInputException::UNDEFINED_VALUE);
        if(is_null(self::$formData['pwd'])) throw new FormInputException('pwd', FormInputException::UNDEFINED_VALUE);

        if(empty(self::$formData['username'])) UserAlertsContainer::add('L\'email de l\'utilisateur est vide.');
        if(empty(self::$formData['firstname']))UserAlertsContainer::add('Le nom d\'utilisateur est vide.');
        if(empty(self::$formData['lastname'])) UserAlertsContainer::add('Le nom de famille de l\'utilisateur est vide.');
        if(empty(self::$formData['pwd'])) UserAlertsContainer::add('Le mot de passe de l\'utilisateur est vide.');

        if(UserAlertsContainer::hasAlerts()) return;

        $entity = new User(self::$formData);
        UsersTable::update($entity);
    }

    private static function deleteUser()
    {
        if(!isset(self::$formData['user_id'])) throw new FormInputException('user_id', FormInputException::UNDEFINED_VALUE);
        if(!is_numeric(self::$formData['user_id'])) throw new FormInputException('user_id', FormInputException::NOT_NUMERIC);
        
        UsersTable::delete(self::$formData['user_id']);
    }
}