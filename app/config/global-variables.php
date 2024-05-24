<?php

// Variables ou constantes ne variant pas en fonction de l'environnement de travail
// Exemple : variables définissant l'architecture des fichiers 

// Dossiers publics
define('ROOT_DIR', 'public');
define('TEMPLATES_DIR', 'templates');
define('ASSETS_DIR', 'assets');

// Dossiers protégés
define('CONFIG_DIR', '../app/config');
define('CONTROLLERS_DIR', '../app/controllers');
define('MODELS_DIR', '../app/models');