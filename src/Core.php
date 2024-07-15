<?php

use App\Utilities\FormValidator;

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
            }
        }
        if(!is_null(ROUTE['template'])) {
            echo TWIG->render(ROUTE['template'], $variables);
        }

        Database::disconnect();
    }
}