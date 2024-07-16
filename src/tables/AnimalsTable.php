<?php

namespace App\Models\Table;

use App\Entity\Animal;
use App\Entity\AnimalImage;
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
                'table' => self::class,
                'fields' => self::FIELDS,
                'joins' => [
                    [
                        'table' => BreedsTable::class,
                        'fields' => [
                            'breed_id',
                            'name',
                        ]
                    ],
                    [
                        'table' => HabitatsTable::class,
                        'fields' => [
                            'habitat_id',
                            'name',
                        ]
                    ],
                ]
            ],
        ];

        $sqlJoins = [];

        $sqlFields = array_map(function($field) {
            return AnimalImagesTable::TABLE_NAME . '.' . $field . ' AS ' . AnimalImagesTable::ENTITY['name'] . '_' . $field;
        }, AnimalImagesTable::FIELDS);
        
        foreach($joins as $join)
        {
            $table = $join['table'];
            $fields = $join['fields'];
            $chainedJoins = $join['joins'] ?? null;

            if(!in_array(TableTrait::class, class_uses($table))) throw new Exception('Argument [0] (array $joinedTablesClasses) contains ' . $table . ' which need to use the trait ' . TableTrait::class . ' to be joined in the query.');
            $sqlJoin = 'JOIN ' . $table::TABLE_NAME;
            $sqlJoin .= ' ON ' . AnimalImagesTable::TABLE_NAME . '.' . $table::PRIMARY_KEY;
            $sqlJoin .= ' = ' . $table::TABLE_NAME . '.' . $table::PRIMARY_KEY;

            if(!is_null($chainedJoins)) {
                foreach($chainedJoins as $chainedJoin)
                {
                    $sqlJoin .= ' JOIN ' . $chainedJoin['table']::TABLE_NAME;
                    $sqlJoin .= ' ON ' . $table::TABLE_NAME . '.' . $chainedJoin['table']::PRIMARY_KEY;
                    $sqlJoin .= ' = ' . $chainedJoin['table']::TABLE_NAME . '.' . $chainedJoin['table']::PRIMARY_KEY;

                    foreach($chainedJoin['fields'] as $chainedField) 
                    {
                        $sqlFields[] = $chainedJoin['table']::TABLE_NAME . '.' . $chainedField . ' AS ' . $chainedJoin['table']::ENTITY['name'] . '_' . $chainedField;
                    }
                }
            }

            foreach($fields as $field)
            {
                $sqlFields[] = $table::TABLE_NAME . '.' . $field . ' AS ' . $table::ENTITY['name'] . '_' . $field;
            }

            $sqlJoins[] = $sqlJoin;
        }
        $sql = 'SELECT ' . implode(', ', $sqlFields) . ' FROM ' . AnimalImagesTable::TABLE_NAME . ' ' . implode(' ', $sqlJoins);
        Database::$statement = Database::$pdo->query($sql);

        $animals = [];
        while($row = Database::$statement->fetch(PDO::FETCH_ASSOC))
        {
            $animalId = $row[AnimalImagesTable::ENTITY['name'] . '_' . self::PRIMARY_KEY];
            $animalImageId = $row[AnimalImagesTable::ENTITY['name'] . '_' . AnimalImagesTable::PRIMARY_KEY];
            foreach($row as $field => $value)
            {
                if(str_contains($field, AnimalImagesTable::ENTITY['name'] . '_')) {
                    $field = str_replace(AnimalImagesTable::ENTITY['name'] . '_', '', $field);
                    $animals[$animalId]['animal_images'][$animalImageId][$field] = $value;
                }

                if(str_contains($field, self::ENTITY['name'] . '_')) {
                    $field = str_replace(self::ENTITY['name'] . '_', '', $field);
                    $animals[$animalId][$field] = $value;
                }

                if(str_contains($field, BreedsTable::ENTITY['name'] . '_')) {
                    $field = str_replace(BreedsTable::ENTITY['name'] . '_', '', $field);
                    $animals[$animalId]['breed'][$field] = $value;
                }

                if(str_contains($field, HabitatsTable::ENTITY['name'] . '_')) {
                    $field = str_replace(HabitatsTable::ENTITY['name'] . '_', '', $field);
                    $animals[$animalId]['habitat'][$field] = $value;
                }
            }
        }

        $animals = array_map(function($animal) {
            $animal['animal_images'] = array_map(function($animalImage) { return new AnimalImage($animalImage); }, $animal['animal_images']);
            $animal['habitat'] = new Habitat($animal['habitat']);
            $animal['breed'] = new Breed($animal['breed']);
            return new Animal($animal);
        }, $animals);

        return $animals;
    }
}