<?php

namespace App\Models\Table;

use App\Entity\Animal;
use App\Interfaces\Tables\AnimalsTableInterface;
use Database;
use Exception;
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

    static public function getOneBy(string $property, $value): Animal
    {
        if(!property_exists(Animal::class, $property)) throw new Exception('Property ' . $property . ' does not exist on Entity Animal.');
        self::$statement = self::$pdo->prepare('SELECT * FROM animals WHERE :property = :val');
        
        self::$statement->bindParam(':property', $property);
        self::$statement->bindParam(':val', $value);

        self::$statement->execute();
        return self::$statement->fetch(PDO::FETCH_CLASS, Animal::class);
    }
}