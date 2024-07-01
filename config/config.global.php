<?php

if(!isset($rootDir)) $rootDir = '../';

// Autorise la création de fixtures sur l'application via la CLI
// ATTENTION : ceci écrase toutes les données de votre base de données !
define('ALLOW_FIXTURES_CREATION', true);

// SRC DIRECTORY
define('APP_DIR', $rootDir . 'src');
define('CONFIG_DIR', $rootDir . 'config');
define('CONTROLLER_DIR', APP_DIR . '/controllers');
define('ADMIN_CONTROLLER_DIR', CONTROLLER_DIR . '/admin');
define('API_CONTROLLER_DIR', CONTROLLER_DIR . '/api');

define('UTILITIES_DIR', APP_DIR . '/utilities');

define('MODELS_DIR', APP_DIR . '/models');
define('TABLES_DIR', APP_DIR . '/tables');
define('ENTITIES_DIR', APP_DIR . '/entities');
define('OBJECTS_DIR', APP_DIR . '/objects');

define('INTERFACES_DIR', APP_DIR . '/interfaces');
define('CONTOLLER_INTERFACES_DIR', INTERFACES_DIR . '/controllers');
define('TABLE_INTERFACES_DIR', INTERFACES_DIR . '/tables');

// PUBLIC DIRECTORY
define('ASSETS_DIR', 'assets');
define('CSS_DIR', ASSETS_DIR . '/css');
define('JS_DIR', ASSETS_DIR . '/js');
define('IMG_DIR', ASSETS_DIR . '/images');
define('UPLOAD_DIR', 'uploads');
define('TEMPLATE_DIR', $rootDir . 'templates');
define('TEMPLATE_PARTS_DIR', $rootDir . 'templates/template-parts');

// REQUIRED FOR AUTOLOADER
define('SRC_FOLDERS', [
    APP_DIR,
    CONTROLLER_DIR,
    UTILITIES_DIR,
    MODELS_DIR,
    ENTITIES_DIR,
    OBJECTS_DIR,
    INTERFACES_DIR,
    CONTOLLER_INTERFACES_DIR,
    TABLE_INTERFACES_DIR,
    ADMIN_CONTROLLER_DIR,
    API_CONTROLLER_DIR,
    TABLES_DIR
]);

require_once 'config.local.php';
