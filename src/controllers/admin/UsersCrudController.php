<?php

use App\Entity\User;
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
            'userId' => $_POST['userId'] ?? null,
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
            default => throw new Exception('A Crud Action need to be defined in the form to determine what this action is on the Entity. Possible values are : CREATE, UPDATE, DELETE.'),
        };
    }

    private static function createUser()
    {
        if(is_null(self::$formData['username'])) throw new Exception('Username need to be specified in the form');
        if(is_null(self::$formData['firstname'])) throw new Exception('Firstname need to be specified in the form');
        if(is_null(self::$formData['lastname'])) throw new Exception('Lastname need to be specified in the form');
        if(is_null(self::$formData['pwd'])) throw new Exception('Password need to be specified in the form');
        if(is_null(self::$formData['role_id'])) throw new Exception('RoleId need to be specified in the form');

        if(empty(self::$formData['username'])) self::$formInputErrors[] = 'Le nom d\'utilisateur renseigné est vide';
        if(empty(self::$formData['firstname'])) self::$formInputErrors[] = 'Le prénom de l\'utilisateur est vide';
        if(empty(self::$formData['lastname'])) self::$formInputErrors[] = 'Le nom de l\'utilisateur est vide';
        if(empty(self::$formData['pwd'])) self::$formInputErrors[] = 'Le mot de passe renseigné est vide';

        $entity = new User(self::$formData);
        if(UsersTable::isAlreadyRegistered($entity)) self::$formInputErrors[] = 'L\'utilisateur renseigné existe déjà !';

        if(!empty(self::$formInputErrors)) return;

        UsersTable::create($entity);
    }

    private static function updateUser()
    {
        if(empty(self::$formData['userId']) || is_null(self::$formData['userId'])) throw new Exception('UserId need to be specified in the form');
        if(is_null(self::$formData['username'])) throw new Exception('Username need to be specified in the form');
        if(is_null(self::$formData['firstname'])) throw new Exception('Firstname need to be specified in the form');
        if(is_null(self::$formData['lastname'])) throw new Exception('Lastname need to be specified in the form');
        if(is_null(self::$formData['pwd'])) throw new Exception('Password need to be specified in the form');

        if(empty(self::$formData['username'])) self::$formInputErrors[] = 'Le nom d\'utilisateur renseigné est vide';
        if(empty(self::$formData['firstname'])) self::$formInputErrors[] = 'Le prénom de l\'utilisateur est vide';
        if(empty(self::$formData['lastname'])) self::$formInputErrors[] = 'Le nom de l\'utilisateur est vide';
        if(empty(self::$formData['pwd'])) self::$formInputErrors[] = 'Le mot de passe est vide';

        if(!empty(self::$formInputErrors)) return;

        $entity = new User(self::$formData);
        UsersTable::update($entity);
    }

    private static function deleteUser()
    {
        if(!isset(self::$formData['userId'])) throw new Exception('userId need to be specified in the form');
        if(!is_numeric(self::$formData['userId'])) throw new Exception('userId need to be a numeric string');
        
        UsersTable::delete(self::$formData['userId']);
    }
}