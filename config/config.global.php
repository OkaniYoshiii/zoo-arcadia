<?php

if(!isset($rootDir)) $rootDir = __DIR__ . '/../';

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

define('TABLES_DIR', APP_DIR . '/tables');
define('TRAITS_DIR', APP_DIR . '/traits');
define('ENTITIES_DIR', APP_DIR . '/entities');
define('OBJECTS_DIR', APP_DIR . '/objects');

define('INTERFACES_DIR', APP_DIR . '/interfaces');

define('EXCEPTIONS_DIR', APP_DIR . '/exceptions');

// PUBLIC DIRECTORY
define('ASSETS_DIR', 'assets');
define('CSS_DIR', ASSETS_DIR . '/css');
define('JS_DIR', ASSETS_DIR . '/js');
define('IMG_DIR', ASSETS_DIR . '/images');
define('UPLOAD_DIR', 'uploads');
define('TEMPLATE_DIR', $rootDir . 'templates');
define('TEMPLATE_PARTS_DIR', $rootDir . 'templates/template-parts');

// ROLES
define('ROLES', ['NONE', 'ROLE_ADMIN', 'ROLE_EMPLOYEE', 'ROLE_VETERINARIAN']);

// REQUIRED FOR AUTOLOADER
define('SRC_FOLDERS', [
    APP_DIR,
    CONTROLLER_DIR,
    UTILITIES_DIR,
    ENTITIES_DIR,
    OBJECTS_DIR,
    INTERFACES_DIR,
    ADMIN_CONTROLLER_DIR,
    API_CONTROLLER_DIR,
    TABLES_DIR,
    TRAITS_DIR,
    EXCEPTIONS_DIR
]);