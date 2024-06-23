<?php

use App\Interface\TableInterface;

class BreedsTable extends Database implements TableInterface
{
    public static function getAll() : array
    {
        self::$statement = self::$pdo->query('SELECT * FROM breeds');
        return self::$statement->fetchAll(PDO::FETCH_CLASS, Breed::class);
    }

    public static function create(array $properties) : void
    {
       self::$statement = self::$pdo->prepare('INSERT INTO breeds (breeds.name) VALUES (:name)');

       self::$statement->bindParam(':name', $properties['name']);

       self::$statement->execute();
    }

    public static function update(array $properties) : void 
    {

    }

    public static function delete(int $id) : void 
    {

    }

    public static function isAlreadyRegistered(array $properties) : bool 
    {
        return false;
    }
}