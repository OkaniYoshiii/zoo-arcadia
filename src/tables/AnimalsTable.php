<?php

namespace App\Models\Table;

use App\Entity\Animal;
use App\Interfaces\Tables\AnimalsTableInterface;
use Database;
use Exception;
use PDO;

class AnimalsTable extends Database implements AnimalsTableInterface
{
    static public function getAll() : array|false
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

    static public function create(Animal $animal) : void
    {
        self::$statement = self::$pdo->prepare('INSERT INTO animals (`firstname`, `state`, `breed_id`, `habitat_id`) VALUES (:firstname, :state, :breed_id, :habitat_id)');
 
        $firstname = $animal->getFirstname();
        $state = $animal->getState();
        $breed_id = $animal->getBreedId();
        $habitat_id = $animal->getHabitatId();
        
        self::$statement->bindParam(':firstname', $firstname);
        self::$statement->bindParam(':state', $state);
        self::$statement->bindParam(':breed_id', $breed_id);
        self::$statement->bindParam(':habitat_id', $habitat_id);
 
        self::$statement->execute();
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

    static public function getOneBy(string $property, $value): Animal|false
    {
        if(!property_exists(Animal::class, $property)) throw new Exception('Property ' . $property . ' does not exist on Entity Animal.');
        self::$statement = self::$pdo->prepare('SELECT * FROM animals WHERE ' . $property . ' = :val');
        
        self::$statement->bindParam(':val', $value);

        self::$statement->execute();
        self::$statement->setFetchMode(PDO::FETCH_CLASS, Animal::class);
        return self::$statement->fetch();
    }
}