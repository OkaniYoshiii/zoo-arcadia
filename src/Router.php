<?php

namespace App;

class Router
{
    private array $currentRoute;

    public function __construct(string $routes_config_path)
    {
        $this->setCurrentRoute($routes_config_path);
    }

    private function setCurrentRoute(string $routes_config_path)
    {
        if(!file_exists($routes_config_path)) throw new \Exception($routes_config_path . ' is not a valid path.');
    
        $routes = json_decode(file_get_contents($routes_config_path), true);

        $this->currentRoute['method'] = REQUEST['method'];
        $this->currentRoute['uri'] = REQUEST['uri'];

        $templateName = $routes[REQUEST['method']][REQUEST['uri']][0];

        if(empty($templateName) && !is_null($templateName)) throw new \Exception('No route found for uri : ' . REQUEST['uri']);
        if(!file_exists(TEMPLATE_DIR . '/' . $templateName)) throw new \Exception('Template \'' . TEMPLATE_DIR . '/' . $templateName . '\' does not exists !');

        $controllerName = $routes[REQUEST['method']][REQUEST['uri']][1] ?? null;

        if(is_null($controllerName)) throw new \Exception('No controller found for uri : ' . REQUEST['uri']);
        if(!file_exists(CONTROLLER_DIR . '/' . $controllerName . '.php') && !file_exists(CONTROLLER_DIR . '/admin/' . $controllerName . '.php' ) && !file_exists(CONTROLLER_DIR . '/api/' . $controllerName . '.php' )) throw new \Exception('Controller \'' . CONTROLLER_DIR . '/' . $controllerName . '.php' . ' does not exists !');
        
        $this->currentRoute['template'] = $templateName;
        $this->currentRoute['controller'] = $controllerName;
        $this->currentRoute['method'] = $this->currentRoute['method'];
    }

    public function getCurrentRoute() : array|null {
        return $this->currentRoute;
    }
}