**Sommaire :**

- [Avant de commencer](#avant-de-commencer)
  - [Identifier le besoin](#identifier-le-besoin)
  - [Personnes référentes](#personnes-référentes)
  - [Déterminer l'environnement de travail](#déterminer-lenvironnement-de-travail)
  - [Déterminer la stack de développement](#déterminer-la-stack-de-développement)
    - [Frontend](#frontend)
    - [Backend](#backend)

## Avant de commencer

### Identifier le besoin

- Application web:
    - Plusieurs types d'utilisateurs :
      - Utilisateur
      - Administrateur
      - Employé
      - Vétérinaire
      - Visiteur
    - Système de connexion
    - Pages :
      - Accueil
        - Section "Avis"
      - Services
      - Habitats
      - Espaces d'aministration
        - Espace administrateur
        - Espace employé
        - Espace vétérinaire
      - Contact
    - Features :
      - Système de connexion
      - Système de mailing
      - Création d'avis et validation 
      - Renseignement des informations sur l'alimentation des animaux depuis l'espace employé
      - Système de commentaires
      - Suivi des informations sur ce qu'ont mangé les animaux grâce aux données fournies par les employés
      - Enregistrement du nombre de consultation des animaux
      - Modification de sections du site via interface administrateur (CMS ?)
      - Création de comptes employé ou vétérinaires depuis l'espace administrateur

- Valeurs à mettre en avant :
  - le bien être des animaux du zoo : 
    - soins apporté aux animaux
    - vétérinaires effectuent des contrôles réguliers
    - les animaux sont heureux
  - écologie
    - zoo entièrement indépendant au niveau des énergies
    - un utilisateur doit ressentir les valeurs de l’écologie
    - fierté de porter des valeurs écologiques
    - NB : les zoos étant mal vus par certaines associations écologiques, il peut être intéressant d'essayer de trouver des "contre-arguments" à ce qui peut être avancé par ces associations, afin que, dans l'idéal, ces dernières puissent se joindre à la cause et grandement valoriser l'image écologique du zoo.
- Volonté d'augmenter la notoriété et l'image de marque du zoo
- Les couleurs et thème doivent évoquer l'écologie :
  - Couleurs plutot vives en nuance de vert
  - Eviter les couleurs froides
  - Eviter les couleurs sombres
  
### Personnes référentes

- Josette - Assisante du directeur
- José - Directeur du zoo

### Déterminer l'environnement de travail

- OS : Windows 11
  - Webserver : WAMP 

- Editeur de texte : Visual Studio Code
- Outil de gestion de projet : Trello
- Maquettage : Penpot

### Déterminer la stack de développement

Concernant la stack de développement, il va falloir faire un récapitulatif de comment je souhaite intégrer toutes les features mentionnées dans la section [Identifier le besoin](#identifier-le-besoin) : 

Concernant l'aspect frontend, on peut voir que très peu de pages sont nécessaires pour la création de ce site si l'on exclut les pages d'administration qui nécessite très peu d'efforts concernant le design. Ceci signifie que je peut passer plus de temps à faire quelque chose de poussé niveau design pour les utilisateurs principaux du site.

#### Frontend

- *CSS :* SASS
- *Javascript :* Typescript
- *Framework WebGL :* THREE.js (en fonction du temps disponible)
- *Bundler :* Vite

Pour le **CSS**, plusieurs choix sont disponibles ... Cependant, je souhaite faire quelque chose de fin, sur lequel j'ai un contrôle total mais aussi sur une base que je maitrise. Je pense donc éviter **Bootstrap** et **Bootstrap** car je les maitrise mal, trouve que leurs composants sont trop standards, difficilement personnalisables et empêche de pouvoir experimenter correctement. De plus, cela nécessite de charger de grosse quantités de lignes de code pour un projet assez petit.

Je pense donc partir sur du **SASS** qui me permettra d'être fin dans mon design tout en gardant une certaine rapidité et flexibilité dans la manière d'écrire mon **CSS**.

___

Concernant le **Javascript**, une fois de plus, il n'y a que très peu de pages à faire ce qui signifie que je peut experimenter et complexifier tout ça si j'ai le souhaite et si le backend ne prend pas trop de temps.

Ne connaissant aucun framework JS, je ne vais pas me lancer dans cette aventure là. De plus, j'aime avoir le controle sur ce que je fais et souhaite expérimenter, je vais donc m'orienter sur du **Javascript** Vanilla ou du **Typescript**.

**Typescript** permet de solidifier la structure de son code et d'avoir une bonne compatbilité entre navigateurs. Je ne vois donc pas de mauvaises raisons de partir sur du **Typescript** hormis le fait que je vais devoir revoir quelques bases.

___

En fonction du temps que j'aurais à ma disposition, j'aimerais bien intégrer un peu de **THREE.js** dans le projet afin de faire une visite en direct du zoo dans un environement 3D. Je peut compter ça en bonus si je vois que j'ai du temps devant moi.

___

Afin de pouvoir optimiser les temps de chargement des pages et l'exécution de mon code, il pourrait être intéressant d'utiliser un Bundler comme **Vite** ou **Webpack** dans l'application. 

Comme il s'agit d'un petit projet, ceci reste relativement optionnel. Ceci dit, c'est toujours bon à prendre.

Ne connaissant pas trop le fonctionnement des Bundler, je pense partir sur **Vite** notamment car c'est celui qui est recommandé par la documentation pour les applications utilisant **THREE.js** (voir : [https://threejs.org/docs/index.html#manual/en/introduction/Installation](https://threejs.org/docs/index.html#manual/en/introduction/Installation))

De cette manière, si la documentation de **THREE.js** fait référence à des commandes dans **Vite**, je ne serais pas perdu.

___

#### Backend

- *Langage :* PHP
- *Framework :* Aucun
- *Librairie :* Aucun
- *Moteur de templates :* Twig
- *Base de données relationnelle :* MySQL
- *ORM :* aucun
- *Base de données non relationnelle :* MongoDB

Le seul langage backend que je connais actuellement est **PHP**. Mon choix se tourne donc naturellement vers cela. Le projet sera naturellement réalisé en modèle **MVC** notamment car c'est un standard côté backend et que maitriser ce modèle est important pour maitriser les différents frameworks **PHP**.

Maintenant se pose la question de si j'utilise un framework ou non. Dans un cadre purement professionnel, où le fait de rendre le produit en avance par rapport à la deadline imposée peut être vu correctement par le client et peut influencer l'image de l'agence, je serais parti sur **Symfony** car beaucoup de features demandées sont simplifiées par **Symfony** comme le Mailing (géré par un service) ou même l'interface d'administration (gérée par EasyAdminBundle).

Ceci dit, je suis en formation, j'aime faire tout moi-même et partir de zéro est aussi extrêmement formateur : on découvre pourquoi des personnes ont décidé de créer des frameworks et on comprend mieux pourquoi les choses ont été faites ainsi.

Je suis curieux de voir comment je vais pouvoir gérer le mailing et les différentes relations entre les roles administrateurs, vétérinaires etc ... et je pense que cela très enrichissant de voir comment faire cela.

Je vais donc partir sur du **PHP** Vanilla même si je sais que cela va complexifier la tache. 

Ayant déjà eu à faire des projets en **PHP** Vanilla, je sais qu'il est compliqué d'obtenir des fichiers de template facilement lisible lorsque des balises **PHP** s'immissent dedans. Je vais donc utiliser **Twig** pour générer mes Vues.

___

Concernant les bases de données, il me faut une base relationnelle et une autre non relationnelle.

Pour la base relationnelle, je vais donc faire du **MySql** Vanilla notamment car c'est le plus répandu et ce que je maitrise le mieux.

Je n'utiliserais pas **Doctrine** car je considère qu'il est certes plus sécurisé que du SQL classique mais manque de certaines fonctionnalités (clause MONTH et WITH par exemple). Il faut alors constamment le surcoucher avec des extensions qui peuvent s'avérer être une source de problèmes et qui n'ont généralement pas des documentations bien étoffées.

___

Pour la base de données non relationnelle, je vais utiliser **MongoDB** car c'est la seule que je connaisse actuellement.
