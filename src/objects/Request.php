<?php

namespace App\Objects;

class Request
{
    public string $uri;
    public string $method;
    public array $parameters;

    public function __construct()
    {
        $this->uri = explode('?',$_SERVER['REQUEST_URI'])[0];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->setParameters();
    }

    private function setParameters() {
        $parameters = explode('?',$_SERVER['REQUEST_URI'])[1] ?? null;
        
        if(is_null($parameters)) return;

        $parameters = explode('&', $parameters);
        
        foreach($parameters as $index => $parameter) 
        {
            $name = explode('=',$parameter)[0];
            $value = explode('=',$parameter)[1];
            unset($parameters[$index]);
            $parameters[$name] = $value;
        }
        $this->parameters = $parameters;
    }
}