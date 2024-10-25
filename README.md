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

Copiez le fichier `.env.local.example` et renommez le en `.env.local`.

Changer les différentes variables d'environnements en fonction de vos besoins. Chaque variable est décrite en commentaire dans le fichier.

NB : certaines variables sont liées au conteneur Docker et sont donc optionnelles. Si vous n'utilisez pas Docker, vous pouvez donc les supprimer.

Une fois cela fait, importez le fichier *arcadia_db* présent à la racine du projet dans votre SGBDR.

**Optionnel :**

Une fois la structure de la base de données établie, vous devriez pouvoir créer des fixtures en lançant la commande :
```
php cmd/fixtures/fixtures.php
```

**!!! ATTENTION !!!**

Ceci efface les données des tables et les remplace par vos fixtures, lancez cette commande uniquement si vous êtes sur de ne pas perdre de données importantes.