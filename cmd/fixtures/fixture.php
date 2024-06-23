<?php

$rootDir = './';

/*
 * Mes require sont relatifs au répertoire où j'ai lancé ma commande
 * 
 * Exemple : si je lance la commande depuis le répertoire 'cmd/fixtures' en faisant 'cd cmd/fixtures', alors, il faudra que mes require reviennet
 * de 2 dossiers en arrières pour se retrouver dans la racine du projet
 * 
 * Par contre, si je lance la commande directement depuis la racine, alors le chemin du fichier que je require doit être relatif à la racine de mn projet
 */
require_once './config/config.global.php';

require_once './src/Autoloader.php';
Autoloader::register();

Database::connect();


function createFoodTypes() 
{
    FoodTypesTable::truncate();
    $values = [
        'Céréales',
        'Céréales',
        'Orge',
        'Blé',
        'Viande',
        'Patate',
    ];

    foreach($values as $value)
    {
        $properties = ['name' => $value];
        FoodTypesTable::create($properties);
    }
}

createFoodTypes();

function createBreeds()
{
    BreedsTable::truncate();
    $values = [
        'Lion',
        'Zèbre',
        'Hyene',
        'Elephant',
        'Tigre'
    ];

    foreach($values as $value)
    {
        $properties = ['name' => $value];
        BreedsTable::create($properties);
    }
}

createBreeds();

function createAnimals()
{
    $breeds = BreedsTable::getAll();
    $habitats = HabitatsTable::getAll();
    
    $values = [
        'firstname' => [
            'Pierre',
            'Bernard',
            'José',
            'Michel'
        ],
        'state' => [
            'Bonne santé',
            'Malade',
            'Bonne santé',
            'Blessé'
        ],
        'breed_id' => [],
        'habitat_id' => [],
    ];

    foreach($breeds as $breed)
    {
        $values['breed_id'][] = $breed->getBreedId();
    };
}


Database::disconnect();