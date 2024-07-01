<?php

namespace App\Models\Table;

use App\Entity\HabitatImage;
use App\Interfaces\Tables\HabitatImagesTableInterface;
use Database;
use Exception;
use PDO;

class HabitatImagesTable extends Database implements HabitatImagesTableInterface
{
    static public function getAll() : array|false
    {
        self::$statement = self::$pdo->query('SELECT * FROM habitat_images');

        return self::$statement->fetchAll(PDO::FETCH_CLASS, HabitatImage::class);
    }

    static public function create(HabitatImage $habitatImage) : void
    {
        self::$statement = self::$pdo->prepare('INSERT INTO habitat_images (`name`, `habitat_id`) VALUES (:name, :habitat_id)');
 
        $name = $habitatImage->getName();
        $habitat_id = $habitatImage->getHabitatId();
        
        self::$statement->bindParam(':name', $name);
        self::$statement->bindParam(':habitat_id', $habitat_id);
 
        self::$statement->execute();
     }

    static public function update(HabitatImage $properties) : void
    {

    }
    static public function delete(int $id) : void
    {

    }
    static public function isAlreadyRegistered(HabitatImage $habitatImage) : bool
    {
        return false;
    }

    static public function getOneBy(string $property, $value): HabitatImage|false
    {
        if(!property_exists(HabitatImage::class, $property)) throw new Exception('Property ' . $property . ' does not exist on Entity HabitatImage.');
        self::$statement = self::$pdo->prepare('SELECT * FROM habitat_images WHERE ' . $property . ' = :val');
        
        self::$statement->bindParam(':val', $value);

        self::$statement->execute();
        self::$statement->setFetchMode(PDO::FETCH_CLASS, HabitatImage::class);
        return self::$statement->fetch();
    }

    static public function getIdOf(HabitatImage $habitatImage) : int|false
    {
        self::$statement = self::$pdo->prepare('SELECT habitat_image_id FROM habitat_images WHERE `name` = :name AND `habitat_id` = :id');

        $name = $habitatImage->getName();
        $habitat_id = $habitatImage->getHabitatId();

        self::$statement->bindParam(':name', $name);
        self::$statement->bindParam(':habitat_id', $habitat_id);

        self::$statement->execute();
        return self::$statement->fetch()[0];
    }
}