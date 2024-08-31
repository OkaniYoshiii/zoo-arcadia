# ECF Arcadia

## Description

Un projet étudiant demandé par l'organisme de formation Studi dans le cadre d'une formation *Développeur web et web mobile - PHP Symfony*.

## Stack de développement

- Sass
- Typescript
- Twig
- SleekDb

## Prérequis pour cloner le projet

- Git
- NodeJs
- Composer
- Un serveur web de votre choix (WAMP, XAMP, LAMP)
  
## Déploiement en local

### Cloner le projet

Ouvrez votre terminal et lancez la commande : 
```
git clone https://github.com/OkaniYoshiii/zoo-arcadia.git
```

Puis : 
```
cd zoo-arcadia
```

### Installation des dépendances
  
*Sass  / Typescript*
```
npm install
```

*Twig / SleekDb*
```
composer install
```

### Configuration BDD

Créez un fichier nommé **config.local.php** dans le dossier **config**. 

Dans ce fichier, rentrez le code suivant :

```php
<?php
	// Variables et constantes spécifiques à un environnement particulier
	// Exemple : l'URL du site, les identifiants de la BDD ...

	// Nom de domaine de votre site
    // http://localhost en local
	define('SITE_URL', 'https://monsite.com');

	// Informations de connexion à votre base de données
	define('DB_DSN', 'mysql:host=localhost;dbname=myDb');
	define('DB_USER', 'user');
	define('DB_PWD', 'pwd');

	// Uri pour se connecter à votre base de données MongoDb
	// Si vous utilisez MongoDbAtlas, cela devrait ressembler à :
	define('MONGODB_URI', 'mongodb+srv://<db_user>:<db_password>@<cluster_name>.h7ubp.mongodb.net/?retryWrites=true&w=majority&appName=<cluster_name>');

	// Chaine de caractères aléatoire unique à votre projet utilisée pour sécuriser les 	mots de passe
	// Le secret doit être de longueur 14 (112 bits) : Recommandation du NIST 	(National Institute of Standards and Technology)
	// Voir : https://en.wikipedia.org/wiki/Pepper_(cryptography)
    define('APP_SECRET', 'HXTAeiDQWLADBm');
```

[...] et modifiez :

- *SITE_URL :* le nom de domaine de votre site
- *DB_DSN :* les informations liées à votre base de données
- *DB_USER :* le nom d'utilisateur de votre base de données
- *DB_PWD :* le mot de passe de votre base de données
- *APP_SECRET :* un chaine de caractères aléatoires d'une longueur de 14 caratères minimum

Une fois cela fait, importez le fichier *arcadia_db* présent à la racine du projet dans votre SGBDR.

**Optionnel :**

Une fois la structure de la base de données établie, vous devriez pouvoir créer des fixtures en lançant la commande :
```
php cmd/fixtures/fixtures.php
```

**!!! ATTENTION !!!**

Ceci efface les données des tables et les remplace par vos fixtures, lancez cette commande uniquement si vous êtes sur de ne pas perdre de données importantes.