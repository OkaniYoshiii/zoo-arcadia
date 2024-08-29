<?php

// phpinfo();
// die();

// APP CONFIG

use App\Exception\RouterException;
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
define('FeedbacksDB', new Store('feedbacks', '../sleekdb', ['timeout' => false]));
define('AnimalsViewsDB', new Store('animalViews', '../sleekdb', ['timeout' => false]));
define('ServicesDB', new Store('services', '../sleekdb', ['timeout' => false]));
define('SchedulesDaysStore', new Store('schedules_days', '../sleekdb', ['timeout' => false, 'auto_cache' => false]));
define('SchedulesHoursStore', new Store('schedules_hours', '../sleekdb', ['timeout' => false, 'auto_cache' => false]));
define('SchedulesStore', new Store('schedules', '../sleekdb', ['timeout' => false]));
define('FormSubmissionsStore', new Store('form_submissions', '../sleekdb', ['timeout' => false]));

use MongoDB\Driver\ServerApi;
$client = new MongoDB\Client(MONGODB_URI, [], ['serverApi' => new ServerApi(ServerApi::V1)]);
define('AnimalViewsCollection', $client->arcadiaDb->animalViews);

// CONTROLLERS AUTOINSTANCIATION
$core = new Core();