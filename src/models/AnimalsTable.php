<?php

use App\Entity\Animal;
use App\Interface\TableInterface;

class AnimalsTable extends Database implements TableInterface
{
    static public function getAll() : array
    {
        self::$statement = self::$pdo->query('SELECT * FROM animals');

        return self::$statement->fetchAll(PDO::FETCH_CLASS, Animal::class);
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