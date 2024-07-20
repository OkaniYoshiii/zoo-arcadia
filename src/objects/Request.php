<?php

namespace App\Objects;

class Request
{
    public string $uri;
    public string $method;
    public array $parameters;

    public function __construct()
    {
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->parameters = (isset($_GET)) ? $_GET : null;
    }
}