<?php

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

            if(ROUTE['method'] === 'POST') {
                $controller->processFormData();
            }

            $variables = $controller->getVariables();
        }

        echo TWIG->render(ROUTE['template'], $variables);

        Database::disconnect();
    }
}