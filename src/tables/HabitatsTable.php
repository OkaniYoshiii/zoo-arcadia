<?php

namespace App\Models\Table;

use App\Entity\Habitat;
use App\Interfaces\Tables\HabitatsTableInterface;
use Database;
use PDO;

class HabitatsTable extends Database implements HabitatsTableInterface
{
    static public function getAll() : array
    {
        self::$statement = self::$pdo->query('SELECT * FROM habitats');
        return self::$statement->fetchAll(PDO::FETCH_CLASS, Habitat::class);
    }
    static public function create(Habitat $properties) : void
    {

    }
    static public function update(Habitat $properties) : void
    {

    }
    static public function delete(int $id) : void
    {

    }
    static public function isAlreadyRegistered(Habitat $properties) : bool
    {
        return false;
    }
}