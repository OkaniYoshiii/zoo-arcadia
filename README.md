# Déploiement du projet en local

## config.local.php

Pour fonctionner, l'application a besoin de se connecter sur une base de données et d'obtenir quelques informations sur votre environement de travail.

Pour cela, il vous faudra créer un fichier nommé "config.local.php" dans le répertoire "config/".

Ce dernier devra contenir les références suivantes : 

```php
<?php

// Variables et constantes spécifiques à un environnement particulier
// Exemple : l'URL du site, les identifiants de la BDD ...

// Nom de domaine de votre site
define('SITE_URL', 'https://monsite.com');

// Informations de connexion à votre base de données
define('DB_DSN', 'mysql:host=localhost;dbname=myDb');
define('DB_USER', 'user');
define('DB_PWD', 'pwd');

// Chaine de caractères aléatoire unique à votre projet utilisée pour sécuriser les mots de passe
// Le secret doit être de longueur 14 (112 bits) : Recommandation du NIST (National Institute of Standards and Technology)
// Voir : https://en.wikipedia.org/wiki/Pepper_(cryptography)
define('APP_SECRET', 'HXTAeiDQWLADBm');
```