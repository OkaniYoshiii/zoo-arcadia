<?php

namespace App\Models\Table;

use App\Entity\Animal;
use App\Entity\EmployeeReport;
use App\Entity\FoodType;
use App\Entity\FoodUnit;
use App\Trait\TableTrait;
use Database;
use Exception;
use PDO;

class EmployeeReportsTable
{
    const TABLE_NAME = 'employee_reports';
    const ENTITY = ['name' => 'EmployeeReport', 'class' => EmployeeReport::class];
    const PRIMARY_KEY = 'employee_report_id';
    const FIELDS = ['date', 'food_quantity', 'food_type_id', 'food_unit_id', 'animal_id'];
    
    use TableTrait;

    public static function getAllWithJoins() : array
    {
        $joins = [
            [
                'table' => FoodTypesTable::class,
                'fields' => [
                    'name',
                ]
            ],
            [
                'table' => AnimalsTable::class,
                'fields' => [
                    'firstname',
                    'state',
                ]
            ],
            [
                'table' => FoodUnitsTable::class,
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

                if(str_contains($field, FoodTypesTable::ENTITY['name']) . '_') {
                    $field = str_replace(FoodTypesTable::ENTITY['name'] . '_', '', $field);
                    $joinedEntities['food_type'][$field] = $value;
                }

                if(str_contains($field, AnimalsTable::ENTITY['name']) . '_') {
                    $field = str_replace(AnimalsTable::ENTITY['name'] . '_', '', $field);
                    $joinedEntities['animal'][$field] = $value;
                }

                if(str_contains($field, FoodUnitsTable::ENTITY['name']) . '_') {
                    $field = str_replace(FoodUnitsTable::ENTITY['name'] . '_', '', $field);
                    $joinedEntities['food_unit'][$field] = $value;
                }
            }

            $entity = new EmployeeReport($entityData);
            $entity->setAnimal(new Animal($joinedEntities['animal']));
            $entity->setFoodType(new FoodType($joinedEntities['food_type']));
            $entity->setFoodUnit(new FoodUnit($joinedEntities['food_unit']));
            $result[] = $entity;
        }

        var_dump($result);

        // $result = Database::$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}