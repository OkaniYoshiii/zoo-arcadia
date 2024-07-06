<?php

namespace App\Models\Table;

use App\Entity\Animal;
use App\Trait\TableTrait;
use Database;
use PDO;

class AnimalsTable
{
    const TABLE_NAME = 'animals';
    const ENTITY = ['name' => 'Animal', 'class' => Animal::class];
    const PRIMARY_KEY = 'animal_id';
    
    use TableTrait;

    public static function getAll() : array|false
    {
        Database::$statement = Database::$pdo->query('SELECT * FROM ' . self::TABLE_NAME);
        $animals = Database::$statement->fetchAll(PDO::FETCH_CLASS, self::ENTITY['class']);

        foreach($animals as $animal)
        {
            $animalViews = AnimalsViewsDB->findById($animal->getAnimalId());
            $views = ($animalViews) ? $animalViews['views'] : 0;
            $animal->setViews($views); 
        }
        
        return $animals;
    }
}