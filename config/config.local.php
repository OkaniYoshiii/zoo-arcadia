<?php

// Variables et constantes spécifiques à un environnement particulier
// Exemple : l'URL du site, les identifiants de la BDD ...

define('SITE_URL', 'http://localhost');

define('DB_DSN', 'mysql:host=localhost;dbname=arcadia_db');
define('DB_USER', 'root');
define('DB_PWD', '');

// Le secret doit être de longueur 14 (112 bits) : Recommandation du NIST (National Institute of Standards and Technology)
// Voir : https://en.wikipedia.org/wiki/Pepper_(cryptography)
define('APP_SECRET', '4F6umcl2sHdjH3');