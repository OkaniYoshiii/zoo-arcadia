<?php

use App\Utilities\FormValidator;
use App\Utilities\Session;

class Core {
    public function __construct()
    {
        $this->render();
    }

    private function render() {
        Database::connect();

        $variables = null;

        if(!ROUTE['hasAccess']) {
            $redirectTo = ($_SESSION['isLoggedIn']) ? '/admin' : '/';
            header('Location: ' . $redirectTo);
            die();
        }
        
        if(!is_null(ROUTE['controller']) && ROUTE['controller'] !== 'default') {

            $controllerName = ROUTE['controller'];
            $controller = new $controllerName();

            $analytics = file_get_contents("php://input") ?? null;
            $analytics = json_decode($analytics, true);
            if(!is_null($analytics)) {
                $controller->processFormData();
            }

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $formValidator = new FormValidator();
                $formValidator->checkDuplicatedFormSubmission();
                $formValidator->checkRequestOrigin();
                $formValidator->checkCsrfToken();
  
                $controller->processFormData();
            }

            if(str_contains(ROUTE['uri'], '/api') && ROUTE['template'] === 'NONE') {
                $controller->getJsonData();
            }

            if(!is_null(ROUTE['template']) && ROUTE['template'] !== 'NONE') {
                $variables = $controller->getVariables();
            }

            if(!str_contains(ROUTE['uri'], '/api') && ROUTE['template'] === 'NONE') {
                $controller->processAndRedirect();
            }

            $_SESSION['csrf_token'] = bin2hex(random_bytes(20));

            if(UserAlertsContainer::hasAlerts()) {
                $variables['alerts'] = UserAlertsContainer::getAlerts();
            }

            $variables['session'] = $_SESSION;
        }

        if(!is_null(ROUTE['template']) && ROUTE['template'] !== 'NONE') {
            echo TWIG->render(ROUTE['template'], $variables);
        }

        Database::disconnect();
    }
}