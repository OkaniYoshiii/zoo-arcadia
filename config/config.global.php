<?php

if(!isset($rootDir)) $rootDir = '../';

// SRC DIRECTORY
define('APP_DIR', $rootDir . 'src');
define('CONFIG_DIR', $rootDir . 'config');
define('CONTROLLER_DIR', APP_DIR . '/controllers');
define('ADMIN_CONTROLLER_DIR', CONTROLLER_DIR . '/admin');
define('API_CONTROLLER_DIR', CONTROLLER_DIR . '/api');

define('MODELS_DIR', APP_DIR . '/models');
define('ENTITIES_DIR', APP_DIR . '/entities');
define('OBJECTS_DIR', APP_DIR . '/objects');
define('INTERFACES_DIR', APP_DIR . '/interfaces');

// PUBLIC DIRECTORY
define('ASSETS_DIR', 'assets');
define('CSS_DIR', ASSETS_DIR . '/css');
define('JS_DIR', ASSETS_DIR . '/js');
define('IMG_DIR', ASSETS_DIR . '/images');
define('TEMPLATE_DIR', $rootDir . 'templates');
define('TEMPLATE_PARTS_DIR', $rootDir . 'templates/template-parts');

// REQUIRED FOR AUTOLOADER
define('SRC_FOLDERS', [APP_DIR, CONTROLLER_DIR, MODELS_DIR, ENTITIES_DIR, OBJECTS_DIR, INTERFACES_DIR, ADMIN_CONTROLLER_DIR, API_CONTROLLER_DIR]);

require_once 'config.local.php';
