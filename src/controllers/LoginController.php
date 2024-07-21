<?php

use App\Entity\User;
use App\Exception\UserInputException;
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

        if(!isset($formData['username'])) throw new FormInputException('username', 'value is undefined');
        if(!isset($formData['pwd'])) throw new FormInputException('pwd', 'value is undefined');

        if(empty($formData['username'])) throw new UserInputException('username', $formData['username'], 'value is empty');
        if(empty($formData['pwd'])) throw new UserInputException('pwd', $formData['pwd'], 'value is empty');
        if(!is_string($formData['username'])) throw new UserInputException('username', $formData['username'], 'value must be of type string');
        if(!is_string($formData['pwd'])) throw new UserInputException('pwd', $formData['pwd'], 'value must be of type string');
        if(!filter_var($formData['username'], FILTER_VALIDATE_EMAIL)) throw new UserInputException('username', 'value must be formatted as an email');

        $user = new User($formData);
        $user = UsersTable::isAlreadyRegistered($user);
        if(!$user) throw new AlreadyRegisteredEntityException(User::class);
        
        Session::regenerateId();

        $roleId = $user->getRoleId();
        $role = RolesTable::findById($roleId);

        $_SESSION['role'] = $role;
        $_SESSION['isLoggedIn'] = true;
    }
}