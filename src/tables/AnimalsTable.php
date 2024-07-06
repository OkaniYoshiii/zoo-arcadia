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
    
    use TableTrait;

    public static function getAll() : array|false
    {
        Database::$statement = Database::$pdo->query('SELECT * FROM ' . self::TABLE_NAME);
        $animals = Database::$statement->fetchAll(PDO::FETCH_CLASS, self::ENTITY['class']);

        foreach($animals as $animal)
        {
            $animalViews = AnimalsViewsDB->findById($animal->getAnimalId());
            if(!$animalViews) continue;
            $animal->setViews($animalViews['views']); 
        }
        
        return $animals;
    }
}