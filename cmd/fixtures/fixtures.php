<?php

use App\Entity\Animal;
use App\Entity\AnimalImage;
use App\Entity\Breed;
use App\Entity\FoodType;
use App\Entity\FoodUnit;
use App\Entity\Habitat;
use App\Entity\HabitatImage;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\VeterinarianReport;
use App\Models\Table\AnimalImagesTable;
use App\Models\Table\AnimalsTable;
use App\Models\Table\BreedsTable;
use App\Models\Table\FoodTypesTable;
use App\Models\Table\FoodUnitsTable;
use App\Models\Table\HabitatImagesTable;
use App\Models\Table\HabitatsTable;
use App\Models\Table\RolesTable;
use App\Models\Table\UsersTable;
use App\Models\Table\VeterinarianReportsTable;
use SleekDB\Classes\IoHelper;
use SleekDB\Store;

$rootDir = './';

require_once './config/config.global.php';

require_once './vendor/autoload.php';

require_once './src/Autoloader.php';
Autoloader::register();

if(!ALLOW_FIXTURES_CREATION) {
    throw new Exception('Fixtures creation is not allowed in this project. If you want to allow this, change ALLOW_FIXTURES_CREATION in config/config.global.php. Be warned : fixtures overwrite data in your database !');
}
$dbDirectory = './sleekdb';

$storeName = 'schedules';
IoHelper::deleteFolder($dbDirectory . '/' . $storeName);
define('SchedulesStore', new Store($storeName, $dbDirectory, ['timeout' => false]));

$storeName = 'schedules_hours';
IoHelper::deleteFolder($dbDirectory . '/' . $storeName);
define('SchedulesHoursStore', new Store($storeName, $dbDirectory, ['timeout' => false]));

$storeName = 'schedules_days';
IoHelper::deleteFolder($dbDirectory . '/' . $storeName);
define('SchedulesDaysStore', new Store($storeName, $dbDirectory, ['timeout' => false]));

Database::connect();

$schedulesHours = [
    [
        'hour' => '8h-9h'
    ],
    [
        'hour' => '9h-10h'
    ],
    [
        'hour' => '10h-11h'
    ],
    [
        'hour' => '11h-12h'
    ],
    [
        'hour' => '12h-13h'
    ],
    [
        'hour' => '13h-14h'
    ],
    [
        'hour' => '14h-15h'
    ],
    [
        'hour' => '15h-16h'
    ],
    [
        'hour' => '16h-17h'
    ],
];

SchedulesHoursStore->insertMany($schedulesHours);

$schedulesDays = [
    [
        'day' => 'Lundi'
    ],
    [
        'day' => 'Mardi'
    ],
    [
        'day' => 'Mercredi'
    ],
    [
        'day' => 'Jeudi'
    ],
    [
        'day' => 'Vendredi'
    ],
    [
        'day' => 'Samedi'
    ],
    [
        'day' => 'Dimanche'
    ],
];

SchedulesDaysStore->insertMany($schedulesDays);

$schedulesDays = SchedulesDaysStore->findAll();
$schedulesHours = SchedulesHoursStore->findAll();
$schedules = [];
foreach($schedulesDays as $day)
{
    foreach($schedulesHours as $hour)
    {
        $schedule = [];
        $schedule['schedules_day_id'] = $day['_id'];
        $schedule['schedules_hour_id'] = $hour['_id'];
        $schedule['isOpen'] = (rand(0, 1) > 0.5) ? true : false ; 
        $schedules[] = $schedule;
    }
}

SchedulesStore->insertMany($schedules);

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
        'role_id' => 1,
    ],
    [
        'username' => 'employee@test.com',
        'pwd' => 'employee',
        'firstname' => 'Damien',
        'lastname' => 'Dupont',
        'role_id' => 2,
    ],
    [
        'username' => 'veterinarian@test.com',
        'pwd' => 'veterinarian',
        'firstname' => 'Michelle',
        'lastname' => 'Crossing',
        'role_id' => 3,
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

$habitatImages = [
    [
        'name' => IMG_DIR . '/bg-savannah-bridge.webp',
        'habitat_id' => 1,
    ],
    [
        'name' => IMG_DIR . '/bg-jungle.webp',
        'habitat_id' => 2,
    ],
    [
        'name' => IMG_DIR . '/bg-africa.webp',
        'habitat_id' => 3,
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
        'breed_id' => 1,
        'habitat_id' => 1,
    ],
    [
        'firstname' => 'Mathieu',
        'state' => 'Sain',
        'breed_id' => 2,
        'habitat_id' => 2,
    ],
    [
        'firstname' => 'Patate',
        'state' => 'Blessé',
        'breed_id' => 3,
        'habitat_id' => 1,
    ],
    [
        'firstname' => 'Pomme',
        'state' => 'Sain',
        'breed_id' => 1,
        'habitat_id' => 3,
    ]
];

$foodUnits = [
    [
        'name' => 'mg',
    ],
    [
        'name' => 'g',
    ],
    [
        'name' => 'kg',
    ],
];

$veterinarianReports = [
    [
        'date' => date('Y-m-d', strtotime('2022-05-23')),
        'detail' => 'Prise de sang et tests oculaires. Aucun soucis à signaler.',
        'food_quantity' => 30,
        'food_unit_id' => 2, 
        'user_id' => 3,
        'food_type_id' => 2,
        'animal_id' => 1,
    ],
];

$animalImages = [
    [
        'name' => IMG_DIR . '/img-elephant.webp',
        'animal_id' => 1,
    ],
    [
        'name' => IMG_DIR . '/img-giraffa-1.webp',
        'animal_id' => 2,
    ],
    [
        'name' => IMG_DIR . '/img-giraffa-2.webp',
        'animal_id' => 3,
    ],
    [
        'name' => IMG_DIR . '/img-giraffa-3.webp',
        'animal_id' => 2,
    ],
    [
        'name' => IMG_DIR . '/img-gorilla.webp',
        'animal_id' => 4,
    ],
];

createRoles($roles);
createUsers($users);
createFoodTypes($foodTypes);
createBreeds($breeds);
createHabitats($habitats);
createHabitatImages($habitatImages);
createAnimals($animals);
createFoodUnits($foodUnits);
createVeterinarianReports($veterinarianReports);
createAnimalImages($animalImages);

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

function createHabitatImages(array $habitatImages) : void
{
    HabitatImagesTable::truncate();

    foreach($habitatImages as $habitatImage)
    {
        $entity = new HabitatImage($habitatImage);
        HabitatImagesTable::create($entity);
    }
}

function createAnimals(array $animals) : void
{  
    AnimalsTable::truncate();
    
    foreach($animals as $animal)
    {
        $entity = new Animal($animal);
        AnimalsTable::create($entity);
    }
}

function createFoodUnits(array $foodUnits) : void
{
    FoodUnitsTable::truncate();

    foreach($foodUnits as $foodUnit)
    {
        $entity = new FoodUnit($foodUnit);
        FoodUnitsTable::create($entity);
    }
}

function createVeterinarianReports(array $veterinarianReports) : void
{
    VeterinarianReportsTable::truncate();

    foreach($veterinarianReports as $veterinarianReport)
    {
        $entity = new VeterinarianReport($veterinarianReport);
        VeterinarianReportsTable::create($entity);
    }
}

function createAnimalImages(array $animalImages) : void
{
    AnimalImagesTable::truncate();

    foreach($animalImages as $animalImage)
    {
        $entity = new AnimalImage($animalImage);
        AnimalImagesTable::create($entity);
    }
}

Database::disconnect();