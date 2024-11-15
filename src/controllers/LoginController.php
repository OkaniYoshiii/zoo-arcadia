<?php

namespace App\Controllers;

use App\Entities\User;
use App\Exceptions\FormInputException;
use App\Tables\RolesTable;
use App\Tables\UsersTable;
use App\Utilities\Session;
use App\Utilities\UserAlertsContainer;

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

        if(!isset($formData['username'])) throw new FormInputException('username', 'value is undefined');
        if(!isset($formData['pwd'])) throw new FormInputException('pwd', 'value is undefined');

        if(empty($formData['username']))  UserAlertsContainer::add('L\'email ne doit pas être vide');
        if(empty($formData['pwd']))  UserAlertsContainer::add('Le mot de passe ne doit pas être vide');
        if(!filter_var($formData['username'], FILTER_VALIDATE_EMAIL))  UserAlertsContainer::add('L\'email renseigné n\'est pas au bon format.');

        if(!is_string($formData['username'])) throw new FormInputException('username', $formData['username'], 'value must be of type string');
        if(!is_string($formData['pwd'])) throw new FormInputException('pwd', $formData['pwd'], 'value must be of type string');
        
        $user = new User($formData);
        $user = UsersTable::isAlreadyRegistered($user);
        if(!$user) UserAlertsContainer::add('Les identifiants renseignés sont incorrects.');
        
        if(UserAlertsContainer::hasAlerts()) return;

        Session::regenerateId();

        $roleId = $user->getRoleId();
        $role = RolesTable::findById($roleId);

        $_SESSION['role'] = $role;
        $_SESSION['isLoggedIn'] = true;
    }
}