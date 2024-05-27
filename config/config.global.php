<?php

// SRC DIRECTORY
define('APP_DIR', '../src');
define('CONFIG_DIR', '../config');
define('CONTROLLER_DIR', APP_DIR . '/controllers');
define('MODELS_DIR', APP_DIR . '/models');
define('ENTITIES_DIR', APP_DIR . '/models/Entities');
define('OBJECTS_DIR', APP_DIR . '/objects');
define('INTERFACES_DIR', APP_DIR . '/interfaces');

// PUBLIC DIRECTORY
define('ASSETS_DIR', 'assets');
define('CSS_DIR', ASSETS_DIR . '/css');
define('JS_DIR', ASSETS_DIR . '/js');
define('IMG_DIR', ASSETS_DIR . '/images');
define('TEMPLATE_DIR', 'templates');
define('TEMPLATE_PARTS_DIR', 'templates/template-parts');

// REQUIRED FOR AUTOLOADER
define('SRC_FOLDERS', [APP_DIR, CONTROLLER_DIR, MODELS_DIR, ENTITIES_DIR, OBJECTS_DIR, INTERFACES_DIR]);

require_once 'config.local.php';
