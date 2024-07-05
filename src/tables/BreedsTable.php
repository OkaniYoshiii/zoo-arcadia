<?php

namespace App\Models\Table;

use App\Entity\Breed;
use App\Interfaces\Tables\BreedsTableInterface;
use Database;
use Exception;
use PDO;

class BreedsTable extends Database implements BreedsTableInterface
{
    static public function getAll(array $joins = []) : array|false
    {
        self::$statement = self::$pdo->query('SELECT * FROM breeds');
        return self::$statement->fetchAll(PDO::FETCH_CLASS, Breed::class);
    }

    static public function create(Breed $breed) : void
    {
       self::$statement = self::$pdo->prepare('INSERT INTO breeds (breeds.name) VALUES (:name)');

       $name = $breed->getName();
       
       self::$statement->bindParam(':name', $name);

       self::$statement->execute();
    }

    static public function update(Breed $properties) : void 
    {

    }

    static public function delete(int $id) : void 
    {

    }

    static public function isAlreadyRegistered(Breed $properties) : bool 
    {
        return false;
    }

    static public function getOneBy(string $property, $value): Breed|false
    {
        if(!property_exists(Breed::class, $property)) throw new Exception('Property ' . $property . ' does not exist on Entity Animal.');
        self::$statement = self::$pdo->prepare('SELECT * FROM breeds WHERE ' . $property . ' = :val');
        
        self::$statement->bindParam(':val', $value);

        self::$statement->execute();
        self::$statement->setFetchMode(PDO::FETCH_CLASS, Breed::class);
        return self::$statement->fetch();
    }
}