<?php

namespace App\Models\Table;

use App\Entity\Animal;
use App\Interfaces\Tables\AnimalsTableInterface;
use Database;
use PDO;

class AnimalsTable extends Database implements AnimalsTableInterface
{
    static public function getAll() : array
    {
        self::$statement = self::$pdo->query('SELECT * FROM animals');

        $animals = self::$statement->fetchAll(PDO::FETCH_CLASS, Animal::class);
        $animals = array_map(function(Animal $animal) {
            $animalsViews = AnimalsViewsDB->findById($animal->getAnimalId())['views'];
            if(!is_null($animalsViews)) $animal->setViews($animalsViews);
            return $animal;
        }, $animals);
        return $animals;
    }

    static public function create(Animal $properties) : void
    {

    }

    static public function update(Animal $properties) : void
    {

    }
    static public function delete(int $id) : void
    {

    }
    static public function isAlreadyRegistered(Animal $properties) : bool
    {
        return false;
    }
}