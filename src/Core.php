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
        
        if(!is_null(ROUTE['controller']) && ROUTE['controller'] !== 'default') {

            $controllerName = ROUTE['controller'];
            $controller = new $controllerName();

            $analytics = file_get_contents("php://input") ?? null;
            $analytics = json_decode($analytics, true);
            if(!is_null($analytics)) {
                $controller->processFormData();
            }

            Session::start();

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $formValidator = new FormValidator();
                $formValidator->checkDuplicatedFormSubmission();
                
                $controller->processFormData();
            }

            if(str_contains(ROUTE['uri'], '/api') && is_null(ROUTE['template'])) {
                $controller->getJsonData();
            }

            if(!is_null(ROUTE['template'])) {
                $variables = $controller->getVariables();
                if(str_contains(ROUTE['uri'], '/admin') && (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] === false)) {
                    header('Location: /');
                    die();
                }
            }

            if(!str_contains(ROUTE['uri'], '/api') && is_null(ROUTE['template'])) {
                $controller->processAndRedirect();
            }

            $variables['session'] = $_SESSION;
        }
        if(!is_null(ROUTE['template'])) {
            echo TWIG->render(ROUTE['template'], $variables);
        }

        Database::disconnect();
    }
}