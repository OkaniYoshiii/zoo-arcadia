<?php

// APP CONFIG

use App\Entity\Schedule;
use App\Exception\RouterException;
use App\Models\Table\SchedulesTable;
use App\Utilities\Session;

require_once '../config/config.global.php';

// TWIG CONFIG
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(TEMPLATE_DIR);
define('TWIG', new \Twig\Environment($loader));

// ENV VARIABLES
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../', '.env.local');
$dotenv->load();

require_once CONFIG_DIR . '/config.twig.php';

// AUTOLOADER
require_once APP_DIR . '/Autoloader.php';
Autoloader::register();

ExceptionHandler::addHandler(RouterException::class, function() {
    http_response_code(404);
    echo TWIG->render('404.html.twig',[]);
});
ExceptionHandler::start();

Session::start();

// REQUEST CONSTANT
use App\Objects\Request;
define('REQUEST', (array) new Request());

// CURRENT ROUTE CONSTANT
use App\Router;

$router = new Router(CONFIG_DIR . '/routes.json');
define('ROUTE', $router->getCurrentRoute());

use MongoDB\Driver\ServerApi;
$client = new MongoDB\Client($_ENV['MONGODB_URI'], [], ['serverApi' => new ServerApi(ServerApi::V1)]);
define('AnimalViewsCollection', $client->selectDatabase($_ENV['MONGODB_NAME'])->selectCollection('animalViews'));
define('FeedbacksCollection', $client->selectDatabase($_ENV['MONGODB_NAME'])->selectCollection('feedbacks'));
define('ServicesCollection', $client->selectDatabase($_ENV['MONGODB_NAME'])->selectCollection('services'));
define('FormSubmissionCollection', $client->selectDatabase($_ENV['MONGODB_NAME'])->selectCollection('formSubmissions'));

// CONTROLLERS AUTOINSTANCIATION
$core = new Core();