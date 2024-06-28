<?php

namespace App\Models\Table;

use App\Entity\FoodType;
use App\Interfaces\Tables\FoodTypesTableInterface;
use Database;
use PDO;

class FoodTypesTable extends Database implements FoodTypesTableInterface
{
    static public function getAll() : array
    {
        self::$statement = self::$pdo->query('SELECT * FROM food_types');

        return self::$statement->fetchAll(PDO::FETCH_CLASS, FoodType::class);
    }

    static public function create(FoodType $properties) : void
    {
        self::$statement = self::$pdo->prepare('INSERT INTO food_types (food_types.name) VALUES (:name)');

        self::$statement->bindParam(':name', $properties['name']);

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
}