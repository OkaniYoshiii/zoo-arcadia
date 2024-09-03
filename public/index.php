<?php

// phpinfo();
// die();

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

// var_dump($_SESSION['role'], ROUTE['roles'], ROUTE['hasAccess']);

use SleekDB\Store;
define('SchedulesDaysStore', new Store('schedules_days', '../sleekdb', ['timeout' => false, 'auto_cache' => false]));
define('SchedulesHoursStore', new Store('schedules_hours', '../sleekdb', ['timeout' => false, 'auto_cache' => false]));

use MongoDB\Driver\ServerApi;
$client = new MongoDB\Client(MONGODB_URI, [], ['serverApi' => new ServerApi(ServerApi::V1)]);
define('AnimalViewsCollection', $client->selectDatabase(MONGODB_DATABASE)->selectCollection('animalViews'));
define('FeedbacksCollection', $client->selectDatabase(MONGODB_DATABASE)->selectCollection('feedbacks'));
define('ServicesCollection', $client->selectDatabase(MONGODB_DATABASE)->selectCollection('services'));
define('FormSubmissionCollection', $client->selectDatabase(MONGODB_DATABASE)->selectCollection('formSubmissions'));

// CONTROLLERS AUTOINSTANCIATION
$core = new Core();