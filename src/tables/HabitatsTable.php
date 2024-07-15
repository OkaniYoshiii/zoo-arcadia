<?php

namespace App\Models\Table;

use App\Entity\Habitat;
use App\Entity\HabitatImage;
use App\Trait\TableTrait;
use Database;
use Exception;
use PDO;

class HabitatsTable
{
    const TABLE_NAME = 'habitats';
    const ENTITY = ['name' => 'Habitat', 'class' => Habitat::class];
    const PRIMARY_KEY = 'habitat_id';
    const FIELDS = ['habitat_id', 'name', 'description', 'veterinarian_comments'];

    use TableTrait;

    public static function getAllWithJoins() : array
    {
        $joins = [
            [
                'table' => self::class,
                'fields' => self::FIELDS,
            ],
        ];

        $sqlJoins = [];

        $sqlFields = array_map(function($field) {
            return HabitatImagesTable::TABLE_NAME . '.' . $field . ' AS ' . HabitatImagesTable::ENTITY['name'] . '_' . $field;
        }, HabitatImagesTable::FIELDS);
        
        foreach($joins as $join)
        {
            $table = $join['table'];
            $fields = $join['fields'];

            if(!in_array(TableTrait::class, class_uses($table))) throw new Exception('Argument [0] (array $joinedTablesClasses) contains ' . $table . ' which need to use the trait ' . TableTrait::class . ' to be joined in the query.');
            $sqlJoin = 'JOIN ' . $table::TABLE_NAME;
            $sqlJoin .= ' ON ' . HabitatImagesTable::TABLE_NAME . '.' . $table::PRIMARY_KEY;
            $sqlJoin .= ' = ' . $table::TABLE_NAME . '.' . $table::PRIMARY_KEY;

            foreach($fields as $field)
            {
                $sqlFields[] = $table::TABLE_NAME . '.' . $field . ' AS ' . $table::ENTITY['name'] . '_' . $field;
            }

            $sqlJoins[] = $sqlJoin;
        }
        $sql = 'SELECT ' . implode(', ', $sqlFields) . ' FROM ' . HabitatImagesTable::TABLE_NAME . ' ' . implode(' ', $sqlJoins);
        Database::$statement = Database::$pdo->query($sql);

        $habitats = [];
        while($row = Database::$statement->fetch(PDO::FETCH_ASSOC))
        {
            $habitatId = $row[HabitatImagesTable::ENTITY['name'] . '_' . self::PRIMARY_KEY];
            foreach($row as $field => $value)
            {
                if(str_contains($field, HabitatImagesTable::ENTITY['name'] . '_')) {
                    $field = str_replace(HabitatImagesTable::ENTITY['name'] . '_', '', $field);
                    $habitats[$habitatId]['habitat_image'][$field] = $value;
                }

                if(str_contains($field, self::ENTITY['name'] . '_')) {
                    $field = str_replace(self::ENTITY['name'] . '_', '', $field);
                    $habitats[$habitatId][$field] = $value;
                }
            }
        }

        $habitats = array_map(function($habitat) {
            $habitat['habitat_image'] = new HabitatImage($habitat['habitat_image']);
            return new Habitat($habitat);
        }, $habitats);

        return $habitats;
    }
}