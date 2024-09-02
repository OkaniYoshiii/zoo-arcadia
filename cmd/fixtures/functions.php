<?php

use App\Entity\Animal;
use App\Entity\AnimalImage;
use App\Entity\Breed;
use App\Entity\EmployeeReport;
use App\Entity\FoodType;
use App\Entity\FoodUnit;
use App\Entity\Habitat;
use App\Entity\HabitatImage;
use App\Entity\Role;
use App\Entity\Schedule;
use App\Entity\ScheduleHour;
use App\Entity\User;
use App\Entity\VeterinarianReport;
use App\Entity\WeekDay;
use App\Models\Table\AnimalImagesTable;
use App\Models\Table\AnimalsTable;
use App\Models\Table\BreedsTable;
use App\Models\Table\EmployeeReportsTable;
use App\Models\Table\FoodTypesTable;
use App\Models\Table\FoodUnitsTable;
use App\Models\Table\HabitatImagesTable;
use App\Models\Table\HabitatsTable;
use App\Models\Table\RolesTable;
use App\Models\Table\ScheduleHoursTable;
use App\Models\Table\SchedulesTable;
use App\Models\Table\UsersTable;
use App\Models\Table\VeterinarianReportsTable;
use App\Models\Table\WeekDaysTable;

function createWeekDays(array $weekDays) : void
{
    WeekDaysTable::truncate();

    foreach($weekDays as $weekDay)
    {
        $entity = new WeekDay($weekDay);
        WeekDaysTable::create($entity);
    }
}

function createScheduleHours(array $scheduleHours) : void
{
    ScheduleHoursTable::truncate();

    foreach($scheduleHours as $scheduleHour)
    {
        $entity = new ScheduleHour($scheduleHour);
        ScheduleHoursTable::create($entity);
    }
}

function createSchedules(array $schedules) : void
{
    SchedulesTable::truncate();

    foreach($schedules as $schedule)
    {
        $entity = new Schedule($schedule);
        SchedulesTable::create($entity);
    }
}


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

function createEmployeeReports(array $employeeReports) : void
{
    EmployeeReportsTable::truncate();

    foreach($employeeReports as $employeeReport)
    {
        $entity = new EmployeeReport($employeeReport);
        EmployeeReportsTable::create($entity);
    }
}