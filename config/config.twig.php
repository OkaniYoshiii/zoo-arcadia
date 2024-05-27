<?php

// TWIG : Configuration des variables globales
// Référence : https://stackoverflow.com/questions/28958370/how-can-i-define-global-variables-inside-a-twig-template-file

TWIG->addGlobal('IMG_DIR', SITE_URL . '/public/assets/img');
TWIG->addGlobal('CSS_DIR', SITE_URL . '/public/assets/css');
TWIG->addGlobal('JS_DIR', SITE_URL . '/public/assets/js');