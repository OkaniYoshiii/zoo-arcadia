<?php

// TWIG : Configuration des variables globales
// Référence : https://stackoverflow.com/questions/28958370/how-can-i-define-global-variables-inside-a-twig-template-file

$twig->addGlobal('IMG_DIR', SITE_URL . '/public/assets/img');
$twig->addGlobal('CSS_DIR', SITE_URL . '/public/assets/css');
$twig->addGlobal('JS_DIR', SITE_URL . '/public/assets/js');