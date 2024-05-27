<?php

class Core {
    public function __construct()
    {
        $this->render();
    }

    private function render() {
        if(is_null(ROUTE)) {
            require_once TEMPLATE_DIR . '/404.php';
            return;
        }

        $variables = null;
        
        if(!is_null(ROUTE['controller']) && ROUTE['controller'] !== 'default') {
            $controllerName = ROUTE['controller'];
            $controller = new $controllerName();
            $variables = $controller->getVariables();
        }

        echo TWIG->render(ROUTE['template'], $variables);
    }
}