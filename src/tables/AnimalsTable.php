<?php

namespace App\Models\Table;

use App\Entity\Animal;
use App\Entity\Breed;
use App\Entity\Habitat;
use App\Trait\TableTrait;
use Database;
use Exception;
use PDO;

class AnimalsTable
{
    const TABLE_NAME = 'animals';
    const ENTITY = ['name' => 'Animal', 'class' => Animal::class];
    const PRIMARY_KEY = 'animal_id';
    const FIELDS = ['animal_id', 'firstname', 'state'];
    
    use TableTrait;

    public static function getAll() : array|false
    {
        Database::$statement = Database::$pdo->query('SELECT * FROM ' . self::TABLE_NAME);
        $animals = Database::$statement->fetchAll(PDO::FETCH_CLASS, self::ENTITY['class']);

        foreach($animals as $animal)
        {
            $animalViews = AnimalsViewsDB->findById($animal->getAnimalId());
            $views = ($animalViews) ? $animalViews['views'] : 0;
            $animal->setViews($views); 
        }
        
        return $animals;
    }

    public static function getAllWithJoins() : array
    {
        $joins = [
            [
                'table' => BreedsTable::class,
                'fields' => [
                    'name',
                ]
            ],
            [
                'table' => HabitatsTable::class,
                'fields' => [
                    'name',
                ]
            ],
        ];

        $sqlJoins = [];
        $aliases = [];

        $sqlFields = array_map(function($field) {
            $aliases[self::ENTITY['name']] = self::ENTITY['name'] . '_' . $field;
            return self::TABLE_NAME . '.' . $field . ' AS ' . self::ENTITY['name'] . '_' . $field;
        }, self::FIELDS);
        
        foreach($joins as $join)
        {
            $table = $join['table'];
            $fields = $join['fields'];

            if(!in_array(TableTrait::class, class_uses($table))) throw new Exception('Argument [0] (array $joinedTablesClasses) contains ' . $table . ' which need to use the trait ' . TableTrait::class . ' to be joined in the query.');
            $sqlJoin = 'JOIN ' . $table::TABLE_NAME;
            $sqlJoin .= ' ON ' . self::TABLE_NAME . '.' . $table::PRIMARY_KEY;
            $sqlJoin .= ' = ' . $table::TABLE_NAME . '.' . $table::PRIMARY_KEY;

            foreach($fields as $field)
            {
                $sqlFields[] = $table::TABLE_NAME . '.' . $field . ' AS ' . $table::ENTITY['name'] . '_' . $field;
                $aliases[$table::ENTITY['name']] = $table::ENTITY['name'] . '_' . $field;
            }

            $sqlJoins[] = $sqlJoin;
        }
        $sql = 'SELECT ' . implode(', ', $sqlFields) . ' FROM ' . self::TABLE_NAME . ' ' . implode(' ', $sqlJoins);

        Database::$statement = Database::$pdo->query($sql);

        $result = [];
        while($row = Database::$statement->fetch(PDO::FETCH_ASSOC))
        {
            $entityData = [];
            $joinedEntities = [];
            foreach($row as $field => $value)
            {
                if(str_contains($field, self::ENTITY['name']) . '_') {
                    $field = str_replace(self::ENTITY['name'] . '_', '', $field);
                    $entityData[$field] = $value;
                }

                if(str_contains($field, BreedsTable::ENTITY['name']) . '_') {
                    $field = str_replace(BreedsTable::ENTITY['name'] . '_', '', $field);
                    $joinedEntities['breed'][$field] = $value;
                }

                if(str_contains($field, HabitatsTable::ENTITY['name']) . '_') {
                    $field = str_replace(HabitatsTable::ENTITY['name'] . '_', '', $field);
                    $joinedEntities['habitat'][$field] = $value;
                }
            }

            $entity = new Animal($entityData);
            $entity->setBreed(new Breed($joinedEntities['breed']));
            $entity->setHabitat(new Habitat($joinedEntities['habitat']));
            $result[] = $entity;
        }

        return $result;
    }
}