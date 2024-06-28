<?php

use App\Entity\FoodType;
use App\Models\Table\BreedsTable;
use App\Models\Table\FoodTypesTable;
use App\Models\Table\HabitatsTable;

$rootDir = './';

require_once './config/config.global.php';

require_once './src/Autoloader.php';
Autoloader::register();

Database::connect();

$habitats = [
    'Savane',
    'Jungle',
    'Marais'
];

$foodTypes = [
    'Céréales',
    'Céréales',
    'Orge',
    'Blé',
    'Viande',
    'Patate',
];

$breeds = [
    'Lion',
    'Zèbre',
    'Hyene',
    'Elephant',
    'Tigre'
];

$animals = [
    [
        'firstname' => 'Pierre',
        'state' => 'Malade',
        'breed' => $breeds[0],
        'habitat' => $habitats[0],
    ],
    [
        'firstname' => 'Pierre',
        'state' => 'Malade',
        'breed' => $breeds[0],
        'habitat' => $habitats[0],
    ],
    [
        'firstname' => 'Pierre',
        'state' => 'Malade',
        'breed' => $breeds[0],
        'habitat' => $habitats[0],
    ],
    [
        'firstname' => 'Pierre',
        'state' => 'Malade',
        'breed' => $breeds[0],
        'habitat' => $habitats[0],
    ]
];

createFoodTypes($foodTypes);
createBreeds($breeds);
createAnimals($animals);

function createFoodTypes(array $foodTypes) : void
{
    FoodTypesTable::truncate();
    
    foreach($foodTypes as $type)
    {
        $foodType = new FoodType();
        $foodType->setName($type);
        FoodTypesTable::create($foodType);
    }
}

function createBreeds(array $values) : void
{
    BreedsTable::truncate();

    foreach($values as $value)
    {
        $properties = ['name' => $value];
        BreedsTable::create($properties);
    }
}


function createAnimals(array $values) : void
{
    $breeds = BreedsTable::getAll();
    $habitats = HabitatsTable::getAll();
    
    foreach($breeds as $breed)
    {
        $values['breed_id'][] = $breed->getBreedId();
    };
}


Database::disconnect();