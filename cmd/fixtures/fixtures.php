<?php

use App\Entity\Animal;
use App\Entity\Breed;
use App\Entity\FoodType;
use App\Entity\Habitat;
use App\Models\Table\AnimalsTable;
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
        'description' => 'bonjour',
        'veterinarian_comments' => 'bonjour',
    ],
    [
        'name' => 'Jungle',
        'description' => 'bonjour',
        'veterinarian_comments' => 'bonjour',
    ],
    [
        'name' => 'Marais',
        'description' => 'bonjour',
        'veterinarian_comments' => 'bonjour',
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
        'breed_name' => $breeds[0]['name'],
        'habitat_name' => $habitats[0]['name'],
    ],
    [
        'firstname' => 'Pierre',
        'state' => 'Malade',
        'breed_name' => $breeds[0]['name'],
        'habitat_name' => $habitats[0]['name'],
    ],
    [
        'firstname' => 'Pierre',
        'state' => 'Malade',
        'breed_name' => $breeds[0]['name'],
        'habitat_name' => $habitats[0]['name'],
    ],
    [
        'firstname' => 'Pierre',
        'state' => 'Malade',
        'breed_name' => $breeds[0]['name'],
        'habitat_name' => $habitats[0]['name'],
    ]
];

createFoodTypes($foodTypes);
createBreeds($breeds);
createHbaitats($habitats);
createAnimals($animals);

function createFoodTypes(array $foodTypes) : void
{
    FoodTypesTable::truncate();
    
    foreach($foodTypes as $foodType)
    {
        $entity = new FoodType($foodType);
        FoodTypesTable::create($entity);
    }
}

function createBreeds(array $breeds) : void
{
    BreedsTable::truncate();

    foreach($breeds as $breed)
    {
        $entity = new Breed($breed);
        BreedsTable::create($entity);
    }
}

function createHbaitats(array $habitats) : void 
{
    HabitatsTable::truncate();
    
    foreach($habitats as $habitat)
    {
        $entity = new Habitat($habitat);
        HabitatsTable::create($entity);
    }
}

function createAnimals(array $animals) : void
{  
    foreach($animals as $animal)
    {
        $breed = BreedsTable::getOneBy('name', $animal['breed_name']);
        $animal['breed_id'] = ($breed) ? $breed->getBreedId() : null;

        $habitat = HabitatsTable::getOneBy('name', $animal['habitat_name']);
        $animal['habitat_id'] = ($habitat) ? $habitat->getHabitatId() : null;

        $entity = new Animal($animal);
        AnimalsTable::create($entity);
    };
}


Database::disconnect();