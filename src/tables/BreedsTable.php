<?php

namespace App\Models\Table;

use App\Entity\Breed;
use App\Interfaces\Tables\BreedsTableInterface;
use Database;
use PDO;

class BreedsTable extends Database implements BreedsTableInterface
{
    public static function getAll() : array
    {
        self::$statement = self::$pdo->query('SELECT * FROM breeds');
        return self::$statement->fetchAll(PDO::FETCH_CLASS, Breed::class);
    }

    public static function create(Breed $properties) : void
    {
       self::$statement = self::$pdo->prepare('INSERT INTO breeds (breeds.name) VALUES (:name)');

       self::$statement->bindParam(':name', $properties['name']);

       self::$statement->execute();
    }

    public static function update(Breed $properties) : void 
    {

    }

    public static function delete(int $id) : void 
    {

    }

    public static function isAlreadyRegistered(Breed $properties) : bool 
    {
        return false;
    }
}