<?php

namespace App\Models\Table;

use App\Entity\Animal;
use App\Entity\Breed;
use App\Entity\EmployeeReport;
use App\Entity\FoodType;
use App\Entity\FoodUnit;
use App\Entity\Habitat;
use App\Trait\TableTrait;
use Database;
use Exception;
use PDO;

class EmployeeReportsTable
{
    const TABLE_NAME = 'employee_reports';
    const ENTITY = ['name' => 'EmployeeReport', 'class' => EmployeeReport::class];
    const PRIMARY_KEY = 'employee_report_id';
    const FIELDS = ['employee_report_id', 'date', 'food_quantity', 'food_type_id', 'food_unit_id', 'animal_id'];
    
    use TableTrait;

    public static function getAllWithJoins() : array
    {
        $joins = [
            [
                'table' => FoodTypesTable::class,
                'fields' => [
                    'food_type_id',
                    'name',
                ]
            ],
            [
                'table' => AnimalsTable::class,
                'fields' => [
                    'animal_id',
                    'breed_id',
                    'firstname',
                    'state',
                ],
                'joins' => [
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
                        ],
                    ]  
                ],
            ],
            [
                'table' => FoodUnitsTable::class,
                'fields' => [
                    'food_unit_id',
                    'name',
                ]
            ],
        ];

        $sqlJoins = [];

        $sqlFields = array_map(function($field) {
            return self::TABLE_NAME . '.' . $field . ' AS ' . self::ENTITY['name'] . '_' . $field;
        }, self::FIELDS);
        
        foreach($joins as $join)
        {
            $table = $join['table'];
            $fields = $join['fields'];
            $chainedJoins = $join['joins'] ?? null;

            if(!in_array(TableTrait::class, class_uses($table))) throw new Exception('Argument [0] (array $joinedTablesClasses) contains ' . $table . ' which need to use the trait ' . TableTrait::class . ' to be joined in the query.');
            $sqlJoin = 'JOIN ' . $table::TABLE_NAME;
            $sqlJoin .= ' ON ' . self::TABLE_NAME . '.' . $table::PRIMARY_KEY;
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
        $sql = 'SELECT ' . implode(', ', $sqlFields) . ' FROM ' . self::TABLE_NAME . ' ' . implode(' ', $sqlJoins);

        Database::$statement = Database::$pdo->query($sql);

        $result = [];
        while($row = Database::$statement->fetch(PDO::FETCH_ASSOC))
        {
            $employeeReportData = [];
            $joinedEntities = [];
            foreach($row as $field => $value)
            {
                if(str_contains($field, self::ENTITY['name'] . '_')) {
                    $field = str_replace(self::ENTITY['name'] . '_', '', $field);
                    $employeeReportData[$field] = $value;
                }

                if(str_contains($field, FoodTypesTable::ENTITY['name'] . '_')) {
                    $field = str_replace(FoodTypesTable::ENTITY['name'] . '_', '', $field);
                    $joinedEntities['food_type'][$field] = $value;
                }

                if(str_contains($field, AnimalsTable::ENTITY['name'] . '_')) {
                    $field = str_replace(AnimalsTable::ENTITY['name'] . '_', '', $field);
                    $joinedEntities['animal'][$field] = $value;
                }

                if(str_contains($field, FoodUnitsTable::ENTITY['name'] . '_')) {
                    $field = str_replace(FoodUnitsTable::ENTITY['name'] . '_', '', $field);
                    $joinedEntities['food_unit'][$field] = $value;
                }

                if(str_contains($field, BreedsTable::ENTITY['name'] . '_')) {
                    $field = str_replace(BreedsTable::ENTITY['name'] . '_', '', $field);
                    $joinedEntities['breed'][$field] = $value;
                }

                if(str_contains($field, HabitatsTable::ENTITY['name'] . '_')) {
                    $field = str_replace(HabitatsTable::ENTITY['name'] . '_', '', $field);
                    $joinedEntities['habitat'][$field] = $value;
                }
            }

            $employeeReport = new EmployeeReport($employeeReportData);

            $animal = new Animal($joinedEntities['animal']);
            $animal->setBreed(new Breed($joinedEntities['breed']));
            $animal->setHabitat(new Habitat($joinedEntities['habitat']));

            $employeeReport->setAnimal($animal);

            $foodType = new FoodType($joinedEntities['food_type']);
            $employeeReport->setFoodType($foodType);

            $foodUnit = new FoodUnit($joinedEntities['food_unit']);
            $employeeReport->setFoodUnit($foodUnit);

            $result[] = $employeeReport;
        }

        return $result;
    }
}