<?php

class UsersCrudController
{
    private array $formInputErrors = [];

    public function getVariables() : array
    {
        return [
            'users' => UsersTable::getUsers(),
            'roles' => RolesTable::getRoles(),
            'formErrors' => $this->formInputErrors,
        ];
    }

    public function processFormData()
    {
        $properties = [
            'username' => $_POST['username'],
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'password' => $_POST['password'],
        ];

        if(isset($_POST['roleId'])) $properties['roleId'] = $_POST['roleId'];

        if(empty($_POST['username'])) $this->formInputErrors[] = 'Le nom d\'utilisateur renseigné est vide';
        if(empty($_POST['firstname'])) $this->formInputErrors[] = 'Le prénom de l\'utilisateur est vide';
        if(empty($_POST['lastname'])) $this->formInputErrors[] = 'Le nom de l\'utilisateur est vide';
        if(empty($_POST['password'])) $this->formInputErrors[] = 'Le mot de passe renseigné est vide';
        if(UsersTable::isUserAlreadyRegistered($properties)) $this->formInputErrors[] = 'L\'utilisateur renseigné existe déjà !';

        if(!empty($this->formInputErrors)) return;

        if(empty($_POST['userId']) && ($_POST['crudAction'] === 'UPDATE' || $_POST['crudAction'] === 'DELETE')) throw new Exception('User id need to be defined in the form in order to process it correctly');
        if(!isset($_POST['roleId']) || (empty($_POST['roleId']) && ($_POST['roleId'] === 'UPDATE' || $_POST['roleId'] === 'CREATE'))) throw new Exception('Role id need to be defined in the form in order to process it correctly');

        match($_POST['crudAction']) {
            'CREATE' => UsersTable::createUser($properties),
            'UPDATE' => UsersTable::updateUser($_POST['userId'], $properties),
            'DELETE' => UsersTable::deleteUser($_POST['userId']),
        };
    }
}