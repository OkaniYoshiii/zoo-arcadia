<?php

use App\Entity\Animal;
use App\Entity\Breed;
use App\Entity\FoodType;
use App\Entity\Habitat;
use App\Entity\Role;
use App\Entity\User;
use App\Models\Table\AnimalsTable;
use App\Models\Table\BreedsTable;
use App\Models\Table\FoodTypesTable;
use App\Models\Table\HabitatsTable;
use App\Models\Table\RolesTable;
use App\Models\Table\UsersTable;

$rootDir = './';

require_once './config/config.global.php';

require_once './src/Autoloader.php';
Autoloader::register();

if(!ALLOW_FIXTURES_CREATION) {
    throw new Exception('Fixtures creation is not allowed in this project. If you want to allow this, change ALLOW_FIXTURES_CREATION in config/config.global.php. Be warned : fixtures overwrite data in your database !');
}

Database::connect();

$roles = [
    [
        'name' => 'ROLE_ADMIN',
    ],
    [
        'name' => 'ROLE_EMPLOYEE',
    ],
    [
        'name' => 'ROLE_VETERINARIAN',
    ],
];

$users = [
    [
        'username' => 'admin@test.com',
        'pwd' => 'admin',
        'firstname' => 'José',
        'lastname' => '',
        'role_name' => $roles[0]['name'],
    ],
    [
        'username' => 'employee@test.com',
        'pwd' => 'employee',
        'firstname' => 'Damien',
        'lastname' => 'Dupont',
        'role_name' => $roles[1]['name'],
    ],
    [
        'username' => 'veterinarian@test.com',
        'pwd' => 'veterinarian',
        'firstname' => 'Michelle',
        'lastname' => 'Crossing',
        'role_name' => $roles[2]['name'],
    ],
];

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

createRoles($roles);
createUsers($users);
createFoodTypes($foodTypes);
createBreeds($breeds);
createHabitats($habitats);
createAnimals($animals);

function createRoles(array $roles) : void
{
    RolesTable::truncate();

    foreach($roles as $role)
    {
        $entity = new Role($role);
        RolesTable::create($entity);
    }
}

function createUsers(array $users) : void
{
    UsersTable::truncate();

    foreach($users as $user)
    {
        $role = RolesTable::getOneBy('name', $user['role_name']);
        $user['role_id'] = ($role) ? $role->getRoleId() : null;
        $entity = new User($user);
        UsersTable::create($entity);
    }
}

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

function createHabitats(array $habitats) : void 
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