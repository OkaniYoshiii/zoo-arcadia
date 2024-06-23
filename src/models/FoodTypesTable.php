<?php

use App\Entity\FoodType;
use App\Interface\TableInterface;

class FoodTypesTable extends Database implements TableInterface
{
    static public function getAll() : array
    {
        self::$statement = self::$pdo->query('SELECT * FROM food_types');

        return self::$statement->fetchAll(PDO::FETCH_CLASS, FoodType::class);
    }

    static public function create(array $properties) : void
    {
        self::$statement = self::$pdo->prepare('INSERT INTO food_types (food_types.name) VALUES (:name)');

        self::$statement->bindParam(':name', $properties['name']);

        self::$statement->execute();
    }

    static public function update(array $properties) : void
    {

    }

    static public function delete(int $id) : void
    {

    }

    static public function isAlreadyRegistered(array $properties): bool
    {
        return false;
    }
}