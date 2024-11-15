<?php

namespace App;

use App\Entities\Role;
use App\Exceptions\RouterException;

class Router
{
    private array $currentRoute;
    private array $request;

    public function __construct(string $routes_config_path, array $request)
    {
        $this->request = $request;
        $this->setCurrentRoute($routes_config_path);
    }

    private function setCurrentRoute(string $routes_config_path)
    {
        if(!file_exists($routes_config_path)) throw new RouterException($routes_config_path . ' is not a valid path.');
    
        $routes = json_decode(file_get_contents($routes_config_path), true);

        if(!isset($routes[$this->request['method']])) throw new RouterException('No routes found with request method : ' . $this->request['method']);
        if(!isset($routes[$this->request['method']][$this->request['uri']])) throw new RouterException('No routes found with request method : ' . $this->request['method'] . ' and request uri : ' . $this->request['uri']);
        
        if(!isset($routes[$this->request['method']][$this->request['uri']][0])) throw new RouterException('Route has no template defined');
        if(!isset($routes[$this->request['method']][$this->request['uri']][1])) throw new RouterException('Route has no controller defined');
        if(!isset($routes[$this->request['method']][$this->request['uri']][2])) throw new RouterException('Route has no roles defined');

        $this->currentRoute['method'] = $this->request['method'];
        $this->currentRoute['uri'] = $this->request['uri'];

        $templateName = $routes[$this->request['method']][$this->request['uri']][0];

        if($templateName !== 'NONE') {
            if(empty($templateName) && !is_null($templateName)) throw new RouterException('No route found for uri : ' . $this->request['uri']);
            if(!file_exists(TEMPLATE_DIR . '/' . $templateName)) throw new RouterException('Template \'' . TEMPLATE_DIR . '/' . $templateName . '\' does not exists !');
        }

        $controllerName = $routes[$this->request['method']][$this->request['uri']][1] ?? null;

        $roles = $routes[$this->request['method']][$this->request['uri']][2];
        if(!is_array($roles)) throw new RouterException('Route roles must be an array. Possible values are : ' .  implode(', ', ROLES));
        if(empty($roles)) throw new RouterException('Route roles is empty. Possible values are : ' .  implode(', ', ROLES));
        if(!in_array('NONE', $roles)) {
            $validRoles = array_filter($roles, function($role) { return in_array($role, ROLES); });
            if(count($validRoles) !== count($roles)) throw new RouterException('Some route roles are not valid. Possible values are : ' .  implode(', ', ROLES));
        } elseif(count($roles) !== 1) {
            throw new RouterException('If route roles contains NONE, then you cannot have multiples roles for that route');
        }

        $hasAccess = (in_array('NONE', $roles));
        if(!in_array('NONE', $roles)) {
            $hasAccess = ($_SESSION['role'] instanceof Role && in_array($_SESSION['role']->getName(), $roles));
        }
        
        $this->currentRoute['template'] = $templateName;
        $this->currentRoute['controller'] = $controllerName;
        $this->currentRoute['method'] = $this->currentRoute['method'];
        $this->currentRoute['roles'] = $roles;
        $this->currentRoute['hasAccess'] = $hasAccess;
    }

    public function getCurrentRoute() : array|null {
        return $this->currentRoute;
    }
}