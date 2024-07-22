<?php

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

            self::logError($exception);

            http_response_code(500);
            echo TWIG->render('500.html.twig', []);
        });
    }

    public static function addHandler(string $exception, callable $callback)
    {
        self::$handlers[] = ['exception' => $exception, 'callback' => $callback];
    }

    private static function logError(Throwable $exception) : void
    {
        $logMessage = date('Y-m-d H:s', strtotime('now')) . ' : ';
        $logMessage .= 'Uncaught Exception in ' . $exception->getFile() . ', line ' . $exception->getLine() . ' : ' . $exception->getMessage();
        $logMessage .= PHP_EOL;
        $logMessage .= $exception->getTraceAsString();
        $logMessage .= PHP_EOL;
        $logMessage .= PHP_EOL;

        error_log($logMessage, 3, '../logs.txt');
    }
}