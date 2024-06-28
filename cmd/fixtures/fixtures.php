<?php

use App\Entity\FoodType;
use App\Models\Table\BreedsTable;
use App\Models\Table\FoodTypesTable;
use App\Models\Table\HabitatsTable;

$rootDir = './';

require_once './config/config.global.php';

require_once './src/Autoloader.php';
Autoloader::register();

if(!ALLOW_FIXTURES_CREATION) {
    throw new Exception('Fixtures creation is not allowed in this project. If you want to allow this, change ALLOW_FIXTURES_CREATION in config/config.global.php. Be warned : fixtures overwrite data in your database !');
}

Database::connect();

$habitats = [
    [
        'name' => 'Savane',
        'description' => 'lorem ipsum',
    ],
    [
        'name' => 'Jungle',
        'description' => 'lorem ipsum',
    ],
    [
        'name' => 'Marais',
        'description' => 'lorem ipsum',
    ],
];

$foodTypes = [
    [
        'name' => 'Céréales',
    ],
    [
        'name' => 'Orge',
    ],
    [
        'name' => 'Blé',
    ],
    [
        'name' => 'Viande',
    ],
    [
        'name' => 'Patate',
    ],
];

$breeds = [
    [
        'name' => 'Lion',
    ],
    [
        'name' => 'Zèbre',
    ],
    [
        'name' => 'Hyene',
    ],
    [
        'name' => 'Elephant',
    ],
    [
        'name' => 'Tigre',
    ],
];

$animals = [
    [
        'firstname' => 'Pierre',
        'state' => 'Malade',
        'breed_id' => $breeds[0],
        'habitat_id' => $habitats[0],
    ],
    [
        'firstname' => 'Pierre',
        'state' => 'Malade',
        'breed_id' => $breeds[0],
        'habitat_id' => $habitats[0],
    ],
    [
        'firstname' => 'Pierre',
        'state' => 'Malade',
        'breed_id' => $breeds[0],
        'habitat_id' => $habitats[0],
    ],
    [
        'firstname' => 'Pierre',
        'state' => 'Malade',
        'breed_id' => $breeds[0],
        'habitat_id' => $habitats[0],
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