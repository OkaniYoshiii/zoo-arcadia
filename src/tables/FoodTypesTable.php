<?php

namespace App\Models\Table;

use App\Entity\FoodType;
use App\Interfaces\Tables\FoodTypesTableInterface;
use Database;
use Exception;
use PDO;

class FoodTypesTable extends Database implements FoodTypesTableInterface
{
    static public function getAll() : array|false
    {
        self::$statement = self::$pdo->query('SELECT * FROM food_types');

        return self::$statement->fetchAll(PDO::FETCH_CLASS, FoodType::class);
    }

    static public function create(FoodType $foodType) : void
    {
        self::$statement = self::$pdo->prepare('INSERT INTO food_types (`name`) VALUES (:name)');

        $name = $foodType->getName();
        
        self::$statement->bindParam(':name', $name);

        self::$statement->execute();
    }

    static public function update(FoodType $properties) : void
    {

    }

    static public function delete(int $id) : void
    {

    }

    static public function isAlreadyRegistered(FoodType $properties): bool
    {
        return false;
    }

    static public function getOneBy(string $property, $value): FoodType|false
    {
        if(!property_exists(FoodType::class, $property)) throw new Exception('Property ' . $property . ' does not exist on Entity Animal.');
        self::$statement = self::$pdo->prepare('SELECT * FROM food_types WHERE ' . $property . ' :val');
        
        self::$statement->bindParam(':val', $value);

        self::$statement->execute();
        self::$statement->setFetchMode(PDO::FETCH_CLASS, FoodType::class);
        return self::$statement->fetch();
    }

    static public function getIdOf(FoodType $foodType) : int|false
    {
        self::$statement = self::$pdo->prepare('SELECT food_tye_id FROM food_types WHERE `name` = :name');

        $name = $foodType->getName();

        self::$statement->bindParam(':name', $name);

        self::$statement->execute();
        return self::$statement->fetch()[0];
    }
}