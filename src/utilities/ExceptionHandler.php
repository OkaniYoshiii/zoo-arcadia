<?php

use App\Exception\UserInputException;

class ExceptionHandler
{
    private static $handlers = [];

    public static function start()
    {
        set_exception_handler(function(Throwable $exception) {
            foreach(self::$handlers as $handler)
            {
                if($exception instanceof $handler['exception']) {
                    $handler['callback']($exception);
                    return;
                }
            }

            http_response_code(500);
            echo 'Erreur 500, impossible d\'afficher le contenu de la page.';
            die();
        });
    }

    public static function addHandler(string $exception, callable $callback)
    {
        self::$handlers[] = ['exception' => $exception, 'callback' => $callback];
    }
}