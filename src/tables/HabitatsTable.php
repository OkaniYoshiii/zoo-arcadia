<?php

namespace App\Models\Table;

use App\Entity\Habitat;
use App\Interfaces\Tables\HabitatsTableInterface;
use Database;
use Exception;
use PDO;

class HabitatsTable extends Database implements HabitatsTableInterface
{
    static public function getAll() : array|false
    {
        self::$statement = self::$pdo->query('SELECT * FROM habitats');
        return self::$statement->fetchAll(PDO::FETCH_CLASS, Habitat::class);
    }
    
    static public function create(Habitat $habitat) : void
    {
        self::$statement = self::$pdo->prepare('INSERT INTO habitats (`name`, `description`) VALUES (:name, :description)');

        $name = $habitat->getName();
        $description = $habitat->getDescription();
        
        self::$statement->bindParam(':name', $name);
        self::$statement->bindParam(':description', $description);

        self::$statement->execute();
    }

    static public function update(Habitat $habitat) : void
    {

    }
    static public function delete(int $id) : void
    {

    }
    static public function isAlreadyRegistered(Habitat $habitat) : bool
    {
        return false;
    }

    static public function getOneBy(string $property, $value): Habitat|false
    {
        if(!property_exists(Habitat::class, $property)) throw new Exception('Property ' . $property . ' does not exist on Entity Animal.');
        self::$statement = self::$pdo->prepare('SELECT * FROM habitats WHERE ' . $property . ' = :val');
        
        self::$statement->bindParam(':val', $value);

        self::$statement->execute();
        self::$statement->setFetchMode(PDO::FETCH_CLASS, Habitat::class);
        return self::$statement->fetch();
    }
}