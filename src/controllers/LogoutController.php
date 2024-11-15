<?php

namespace App\Controllers;

use App\Utilities\Session;

class LogoutController
{
    public function processAndRedirect()
    {
        Session::unset();
        Session::regenerateId();
        header('Location: /');
        die();
    }
}