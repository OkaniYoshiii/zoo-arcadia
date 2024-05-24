<?php

require_once '../app/config/env-variables.php';
require_once '../app/config/global-variables.php';
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(TEMPLATES_DIR);
$twig = new \Twig\Environment($loader);

require_once '../app/config/twig-variables.php';