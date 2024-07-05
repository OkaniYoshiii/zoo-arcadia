<?php

namespace App\Models\Table;

use App\Entity\FoodUnit;
use App\Interfaces\Tables\FoodUnitsTableInterface;
use Database;
use Exception;
use PDO;

class FoodUnitsTable extends Database implements FoodUnitsTableInterface
{
    static public function getAll(array $joins = []) : array|false
    {
        self::$statement = self::$pdo->query('SELECT * FROM food_units');

        return self::$statement->fetchAll(PDO::FETCH_CLASS, FoodUnit::class);
    }

    static public function create(FoodUnit $foodUnit) : void
    {
        self::$statement = self::$pdo->prepare('INSERT INTO food_units (`name`) VALUES (:name)');

        $name = $foodUnit->getName();
        
        self::$statement->bindParam(':name', $name);

        self::$statement->execute();
    }

    static public function update(FoodUnit $properties) : void
    {

    }

    static public function delete(int $id) : void
    {

    }
}