<?php

// APP CONFIG

use App\Core;
use App\Exceptions\RouterException;
use App\Utilities\ExceptionHandler;
use App\Utilities\Session;
use MongoDB\Driver\ServerApi;
use App\Objects\Request;

require_once '../config/config.global.php';

// TWIG CONFIG
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(TEMPLATE_DIR);
define('TWIG', new \Twig\Environment($loader));

// ENV VARIABLES
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../', '.env.local');
$dotenv->load();

require_once CONFIG_DIR . '/config.twig.php';

ExceptionHandler::addHandler(RouterException::class, function(RouterException $routerException) {
    echo $routerException->getMessage();
    http_response_code(404);
    echo TWIG->render('404.html.twig',[]);
});
ExceptionHandler::start();

Session::start();

$request = (array) new Request();

// CURRENT ROUTE CONSTANT
use App\Router;

$router = new Router(CONFIG_DIR . '/routes.json', $request);
define('ROUTE', $router->getCurrentRoute());

if(MONGODB_FLAG_ENABLED) {
    $client = new MongoDB\Client($_ENV['MONGODB_URI'], [], ['serverApi' => new ServerApi(ServerApi::V1)]);
    define('AnimalViewsCollection', $client->selectDatabase($_ENV['MONGODB_NAME'])->selectCollection('animalViews'));
    define('FeedbacksCollection', $client->selectDatabase($_ENV['MONGODB_NAME'])->selectCollection('feedbacks'));
    define('ServicesCollection', $client->selectDatabase($_ENV['MONGODB_NAME'])->selectCollection('services'));
    define('FormSubmissionCollection', $client->selectDatabase($_ENV['MONGODB_NAME'])->selectCollection('formSubmissions'));
}

// CONTROLLERS AUTOINSTANCIATION
$core = new Core();