<?php

namespace App\Models\Table;

use App\Entity\AnimalImage;
use App\Interfaces\Tables\AnimalImagesTableInterface;
use Database;
use Exception;
use PDO;

class AnimalImagesTable extends Database implements AnimalImagesTableInterface
{
    static public function getAll() : array|false
    {
        self::$statement = self::$pdo->query('SELECT * FROM animal_images');
        return self::$statement->fetchAll(PDO::FETCH_CLASS, AnimalImage::class);
    }

    static public function create(AnimalImage $animalImage) : void
    {
       self::$statement = self::$pdo->prepare('INSERT INTO animal_images (`name`, `animal_id`) VALUES (:name, :animal_id)');

       $name = $animalImage->getName();
       $animal_id = $animalImage->getAnimalId();
       
       self::$statement->bindParam(':name', $name);
       self::$statement->bindParam(':animal_id', $animal_id);

       self::$statement->execute();
    }

    static public function update(AnimalImage $properties) : void 
    {

    }

    static public function delete(int $id) : void 
    {

    }

    static public function isAlreadyRegistered(AnimalImage $properties) : bool 
    {
        return false;
    }

    static public function getOneBy(string $property, $value): AnimalImage|false
    {
        if(!property_exists(AnimalImage::class, $property)) throw new Exception('Property ' . $property . ' does not exist on Entity Animal.');
        self::$statement = self::$pdo->prepare('SELECT * FROM animal_images WHERE ' . $property . ' = :val');
        
        self::$statement->bindParam(':val', $value);

        self::$statement->execute();
        self::$statement->setFetchMode(PDO::FETCH_CLASS, AnimalImage::class);
        return self::$statement->fetch();
    }
}