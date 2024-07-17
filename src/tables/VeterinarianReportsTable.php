<?php

namespace App\Models\Table;

use App\Entity\Animal;
use App\Entity\FoodType;
use App\Entity\FoodUnit;
use App\Entity\User;
use App\Entity\VeterinarianReport;
use App\Trait\TableTrait;
use Database;
use Exception;
use PDO;

class VeterinarianReportsTable
{
    const TABLE_NAME = 'veterinarian_reports';
    const ENTITY = ['name' => 'VeterinarianReport', 'class' => VeterinarianReport::class];
    const PRIMARY_KEY = 'veterinarian_report_id';
    const FIELDS = ['veterinarian_report_id', 'date', 'detail', 'food_quantity', 'user_id', 'food_type_id', 'food_unit_id'];

    use TableTrait;

    public static function getAllWithJoins() : array
    {
        $joins = [
            [
                'table' => UsersTable::class,
                'fields' => [
                    'username',
                    'firstname',
                    'lastname',
                ]
            ],
            [
                'table' => FoodTypesTable::class,
                'fields' => [
                    FoodTypesTable::PRIMARY_KEY,
                    'name',
                ]
            ],
            [
                'table' => FoodUnitsTable::class,
                'fields' => [
                    FoodUnitsTable::PRIMARY_KEY,
                    'name',
                ]
            ],
            [
                'table' => AnimalsTable::class,
                'fields' => [
                    AnimalsTable::PRIMARY_KEY,
                    'firstname',
                ],
                'joins' => [
                        [
                            'table' => HabitatsTable::class,
                            'fields' => [
                                'name',
                            ]
                        ],
                        [
                            'table' => BreedsTable::class,
                            'fields' => [
                                'name',
                            ]
                        ]
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
            $sqlJoin = 'LEFT JOIN ' . $table::TABLE_NAME;
            $sqlJoin .= ' ON ' . self::TABLE_NAME . '.' . $table::PRIMARY_KEY;
            $sqlJoin .= ' = ' . $table::TABLE_NAME . '.' . $table::PRIMARY_KEY;

            foreach($fields as $field)
            {
                $sqlFields[] = $table::TABLE_NAME . '.' . $field . ' AS ' . $table::ENTITY['name'] . '_' . $field;
            }

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

            $sqlJoins[] = $sqlJoin;
        }
        $sql = 'SELECT ' . implode(', ', $sqlFields) . ' FROM ' . self::TABLE_NAME . ' ' . implode(' ', $sqlJoins);
        Database::$statement = Database::$pdo->query($sql);

        $veterinarianReports = [];
        while($row = Database::$statement->fetch(PDO::FETCH_ASSOC))
        {
            $veterinarianReportId = $row[self::ENTITY['name'] . '_' . self::PRIMARY_KEY];
            foreach($row as $field => $value)
            {
                if(str_contains($field, self::ENTITY['name'] . '_')) {
                    $field = str_replace(self::ENTITY['name'] . '_', '', $field);
                    $veterinarianReports[$veterinarianReportId][$field] = $value;
                }

                if(str_contains($field, FoodTypesTable::ENTITY['name'] . '_')) {
                    $field = str_replace(FoodTypesTable::ENTITY['name'] . '_', '', $field);
                    $veterinarianReports[$veterinarianReportId]['food_type'][$field] = $value;
                }

                if(str_contains($field, FoodUnitsTable::ENTITY['name'] . '_')) {
                    $field = str_replace(FoodUnitsTable::ENTITY['name'] . '_', '', $field);
                    $veterinarianReports[$veterinarianReportId]['food_unit'][$field] = $value;
                }

                if(str_contains($field, UsersTable::ENTITY['name'] . '_')) {
                    $field = str_replace(UsersTable::ENTITY['name'] . '_', '', $field);
                    $veterinarianReports[$veterinarianReportId]['user'][$field] = $value;
                }

                if(str_contains($field, AnimalsTable::ENTITY['name'] . '_')) {
                    $field = str_replace(AnimalsTable::ENTITY['name'] . '_', '', $field);
                    $veterinarianReports[$veterinarianReportId]['animal'][$field] = $value;
                }
            }
        }

        $veterinarianReports = array_map(function($report) {
            $report['food_type'] = new FoodType($report['food_type']);
            $report['food_unit'] = new FoodUnit($report['food_unit']);
            $report['user'] = new User($report['user']);
            $report['animal'] = new Animal($report['animal']);
            return new VeterinarianReport($report);
        }, $veterinarianReports);

        return $veterinarianReports;
    }
}