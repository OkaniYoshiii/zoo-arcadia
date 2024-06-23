<?php

namespace App\Models\Table;

use App\Entity\Habitat;
use App\Interface\TableInterface;
use Database;
use PDO;

class HabitatsTable extends Database implements TableInterface
{
    static public function getAll() : array
    {
        self::$statement = self::$pdo->query('SELECT * FROM habitats');
        self::$statement->fetchAll(PDO::FETCH_CLASS, Habitat::class);
        return [];
    }
    static public function create(array $properties) : void
    {

    }
    static public function update(array $properties) : void
    {

    }
    static public function delete(int $id) : void
    {

    }
    static public function isAlreadyRegistered(array $properties) : bool
    {
        return false;
    }
}