<?php

use App\Database;

$rootDir = './';

require_once './config/config.global.php';

require_once './vendor/autoload.php';

// ENV VARIABLES
$dotenv = Dotenv\Dotenv::createImmutable('./', '.env.local');
$dotenv->load();

if(!ALLOW_FIXTURES_CREATION) {
    throw new Exception('Fixtures creation is not allowed in this project. If you want to allow this, change ALLOW_FIXTURES_CREATION in config/config.global.php. Be warned : fixtures overwrite data in your database !');
}
require_once 'functions.php';
require_once 'data.php';

echo 'Démarrage de la création des fixtures :';
echo PHP_EOL;

echo 'Connexion à la base de données ...';
echo PHP_EOL;

Database::connect();

echo 'Connexion réussie !';
echo PHP_EOL;

echo 'Insertion des différentes plages horaires où le zoo peut potentiellement être ouvert/fermé  ...';
echo PHP_EOL;

createScheduleHours($scheduleHours);

echo 'Insertion réussie !';
echo PHP_EOL;

echo 'Insertion des jours de la semaine  ...';
echo PHP_EOL;

createWeekDays($weekDays);

echo 'Insertion réussie !';
echo PHP_EOL;

echo 'Insertion des horaires d\'ouverture/fermeture du zoo ...';
echo PHP_EOL;

createSchedules($schedules);

echo 'Insertion réussie !';
echo PHP_EOL;


echo 'Insertion des roles ...';
echo PHP_EOL;

try {
createRoles($roles);
    
} catch(Throwable $e) {
    echo $e->getMessage();
}

echo 'Insertionréussie !';
echo PHP_EOL;

echo 'Insertion des utilisateurs ...';
echo PHP_EOL;

createUsers($users);

echo 'Insertion réussie !';
echo PHP_EOL;

echo 'Insertion des types de nourriture ...';
echo PHP_EOL;

createFoodTypes($foodTypes);

echo 'Insertion réussie !';
echo PHP_EOL;

echo 'Insertion des espèces ...';
echo PHP_EOL;

createBreeds($breeds);

echo 'Insertion réussie !';
echo PHP_EOL;

echo 'Insertion des habitats ...';
echo PHP_EOL;

createHabitats($habitats);

echo 'Insertion réussie !';
echo PHP_EOL;

echo 'Insertion des images d\'habitats ...';
echo PHP_EOL;

createHabitatImages($habitatImages);

echo 'Insertion réussie !';
echo PHP_EOL;

echo 'Insertion d\'animaux ...';
echo PHP_EOL;

try {
    createAnimals($animals);
} catch(Throwable $e) {
    echo $e->getMessage();
    die();
}


echo 'Insertion réussie !';
echo PHP_EOL;

echo 'Insertion des unités de mesure de la nourriture ...';
echo PHP_EOL;

createFoodUnits($foodUnits);

echo 'Insertion réussie !';
echo PHP_EOL;

echo 'Insertion des raports vétérinaires ...';
echo PHP_EOL;

createVeterinarianReports($veterinarianReports);

echo 'Insertion réussie !';
echo PHP_EOL;

echo 'Insertion des images d\'animaux ...';
echo PHP_EOL;

createAnimalImages($animalImages);

echo 'Insertion réussie !';
echo PHP_EOL;

echo 'Insertion des rapports d\'employés ...';
echo PHP_EOL;

createEmployeeReports($employeeReports);

echo 'Insertion réussie !';
echo PHP_EOL;

Database::disconnect();