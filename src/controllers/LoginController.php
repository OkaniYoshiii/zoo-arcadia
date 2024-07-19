<?php

use App\Entity\User;
use App\Models\Table\RolesTable;
use App\Models\Table\UsersTable;
use App\Utilities\Session;

class LoginController
{
    public function getVariables(): array
    {
        if($_SESSION['isLoggedIn'] === true) {
            header('Location: /');
            die();
        }
        return [];
    }

    public function processFormData()
    {
        $formData = [
            'username' => $_POST['username'] ?? null,
            'pwd' => $_POST['pwd'] ?? null,
        ];

        if(!isset($formData['username'])) throw new Exception('No username sent in the form.');
        if(!isset($formData['pwd'])) throw new Exception('No pwd sent in the form.');

        if(empty($formData['username'])) throw new Exception('Empty username sent in the form');
        if(empty($formData['pwd'])) throw new Exception('Empty pwd sent in the form');

        if(!is_string($formData['username'])) throw new Exception('username is not a string');
        if(!is_string($formData['pwd'])) throw new Exception('pwd is not a string');
        if(!filter_var($formData['username'], FILTER_VALIDATE_EMAIL)) throw new Exception('username is not an email.');

        $user = new User($formData);
        $user = UsersTable::isAlreadyRegistered($user);
        if(!($user instanceof User)) throw new Exception('User has not been registered before trying to log-in.');

        Session::regenerateId();

        $roleId = $user->getRoleId();
        $role = RolesTable::findById($roleId);

        $_SESSION['role'] = $role;
        $_SESSION['isLoggedIn'] = true;
    }
}