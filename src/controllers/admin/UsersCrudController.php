<?php

use App\Entity\User;
use App\Exception\UserInputException;
use App\Models\Table\RolesTable;
use App\Models\Table\UsersTable;

class UsersCrudController
{
    private static array $formInputErrors = [];
    private static array $formData;

    public function getVariables() : array
    {
        return [
            'users' => UsersTable::getAll(),
            'roles' => RolesTable::getAll(),
            'formErrors' => self::$formInputErrors,
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

        if(empty(self::$formData['username']))  throw new UserInputException('username', UserInputException::EMPTY_VALUE);
        if(empty(self::$formData['firstname']))  throw new UserInputException('username', UserInputException::EMPTY_VALUE);
        if(empty(self::$formData['lastname']))  throw new UserInputException('username', UserInputException::EMPTY_VALUE);
        if(empty(self::$formData['pwd'])) throw new UserInputException('username', UserInputException::EMPTY_VALUE);

        $entity = new User(self::$formData);
        if(UsersTable::isAlreadyRegistered($entity)) throw new UserInputException(null, 'User has already been registered');

        if(!empty(self::$formInputErrors)) return;

        UsersTable::create($entity);
    }

    private static function updateUser()
    {
        if(empty(self::$formData['user_id']) || is_null(self::$formData['user_id'])) throw new FormInputException('user_id', FormInputException::UNDEFINED_VALUE);
        if(is_null(self::$formData['username'])) throw new FormInputException('username', FormInputException::UNDEFINED_VALUE);
        if(is_null(self::$formData['firstname'])) throw new FormInputException('firstname', FormInputException::UNDEFINED_VALUE);
        if(is_null(self::$formData['lastname'])) throw new FormInputException('lastname', FormInputException::UNDEFINED_VALUE);
        if(is_null(self::$formData['pwd'])) throw new FormInputException('pwd', FormInputException::UNDEFINED_VALUE);

        if(empty(self::$formData['username'])) throw new UserInputException('pwd', UserInputException::EMPTY_VALUE);
        if(empty(self::$formData['firstname'])) throw new UserInputException('pwd', UserInputException::EMPTY_VALUE);
        if(empty(self::$formData['lastname'])) throw new UserInputException('pwd', UserInputException::EMPTY_VALUE);
        if(empty(self::$formData['pwd'])) throw new UserInputException('pwd', UserInputException::EMPTY_VALUE);

        if(!empty(self::$formInputErrors)) return;

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