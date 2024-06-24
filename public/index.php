<?php

// APP CONFIG
require_once '../config/config.global.php';

// TWIG CONFIG
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(TEMPLATE_DIR);
define('TWIG', new \Twig\Environment($loader));

require_once CONFIG_DIR . '/config.twig.php';

// AUTOLOADER
require_once APP_DIR . '/Autoloader.php';
Autoloader::register();

// REQUEST CONSTANT
use App\Objects\Request;
define('REQUEST', (array) new Request());

// CURRENT ROUTE CONSTANT
use App\Router;

// try {
    $router = new Router(CONFIG_DIR . '/routes.json');
    define('ROUTE', $router->getCurrentRoute());
// } catch(Exception $e) {
//     http_response_code(404);
//     echo TWIG->render('404.html.twig',[]);
//     die();
// }

use SleekDB\Store;
define('FeedbacksDB', new Store("feedbacks", '../sleekdb', ["timeout" => false]));

// CONTROLLERS AUTOINSTANCIATION
$core = new Core();