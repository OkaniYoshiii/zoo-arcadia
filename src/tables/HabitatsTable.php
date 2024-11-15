<?php

namespace App\Tables;

use App\Database;
use App\Entities\Animal;
use App\Entities\AnimalImage;
use App\Entities\Breed;
use App\Entities\Habitat;
use App\Entities\HabitatImage;
use App\Entities\VeterinarianReport;
use App\Traits\TableTrait;
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

    public static function getFrontendHabitats() : array
    {
        $tables = [
            [
                'name' => self::TABLE_NAME,
                'fields' => [
                    self::PRIMARY_KEY,
                    'name',
                    'description',
                ]
            ],
            [
                'name' => HabitatImagesTable::TABLE_NAME,
                'fields' => [
                    HabitatImagesTable::PRIMARY_KEY,
                    'name',
                ]
            ],
            [
                'name' => AnimalsTable::TABLE_NAME,
                'fields' => [
                    AnimalsTable::PRIMARY_KEY,
                    'firstname',
                    'state'
                ]
            ],
            [
                'name' => BreedsTable::TABLE_NAME,
                'fields' => [
                    BreedsTable::PRIMARY_KEY,
                    'name',
                ]
            ],
            [
                'name' => VeterinarianReportsTable::TABLE_NAME,
                'fields' => [
                    VeterinarianReportsTable::PRIMARY_KEY,
                    'date',
                    'detail',
                    'food_quantity',
                ]
            ],
            [
                'name' => AnimalImagesTable::TABLE_NAME,
                'fields' => [
                    AnimalImagesTable::PRIMARY_KEY,
                    'name',
                ]
            ],
        ];

        $sqlFields = array_map(function($table) {
            $fields = array_map(function($field) use ($table) {
                return $table['name'] . '.' . $field . ' AS ' . $table['name'] . '_' . $field;
            }, $table['fields']);
            return implode(', ', $fields);
        }, $tables);
        $select = 'SELECT ' . implode(', ', $sqlFields) . '';
        $from =' FROM habitats ';
        $joins = 'JOIN habitat_images ON habitat_images.habitat_id = habitats.habitat_id
        JOIN animals ON animals.habitat_id = habitats.habitat_id
        JOIN breeds ON breeds.breed_id = animals.breed_id
        JOIN animal_images ON animals.animal_id = animal_images.animal_id
        LEFT JOIN veterinarian_reports ON animals.animal_id = veterinarian_reports.animal_id';
        $sql = $select . $from . $joins;

        Database::$statement = Database::$pdo->query($sql);

        $habitats = [];
        while($row = Database::$statement->fetch(PDO::FETCH_ASSOC))
        {
            $habitatId = $row['habitats_habitat_id'];
            $animalId = $row['animals_animal_id'];
            $breedId = $row['breeds_breed_id'];
            $veterinarian_report_id = $row['veterinarian_reports_veterinarian_report_id'];
            $animal_image_id = $row['animal_images_animal_image_id'];

            $habitats[$habitatId]['name'] = $row['habitats_name'];
            $habitats[$habitatId]['description'] = $row['habitats_description'];

            $habitats[$habitatId]['habitat_image']['name'] = $row['habitat_images_name'];

            $habitats[$habitatId]['breeds'][$breedId]['name'] = $row['breeds_name'];

            $habitats[$habitatId]['breeds'][$breedId]['animals'][$animalId]['animal_id'] = $row['animals_animal_id'];
            $habitats[$habitatId]['breeds'][$breedId]['animals'][$animalId]['firstname'] = $row['animals_firstname'];
            $habitats[$habitatId]['breeds'][$breedId]['animals'][$animalId]['state'] = $row['animals_state'];

            $habitats[$habitatId]['breeds'][$breedId]['animals'][$animalId]['state'] = $row['animals_state'];

            $habitats[$habitatId]['breeds'][$breedId]['animals'][$animalId]['animal_images'][$animal_image_id]['name'] = $row['animal_images_name'];

            if(!is_null($veterinarian_report_id)) {
                $habitats[$habitatId]['breeds'][$breedId]['animals'][$animalId]['veterinarian_reports'][$veterinarian_report_id]['date'] = $row['veterinarian_reports_date'];
                $habitats[$habitatId]['breeds'][$breedId]['animals'][$animalId]['veterinarian_reports'][$veterinarian_report_id]['detail'] = $row['veterinarian_reports_detail'];
                $habitats[$habitatId]['breeds'][$breedId]['animals'][$animalId]['veterinarian_reports'][$veterinarian_report_id]['food_quantity'] = $row['veterinarian_reports_food_quantity'];
            }
        }


        $habitats = array_map(function($habitat) {
            $habitat['habitat_image'] = new HabitatImage($habitat['habitat_image']);
                $habitat['breeds'] = array_map(function($breed) {
                        $breed['animals'] = array_map(function($animal) {
                            $animal['animal_images'] = array_map(function($animal_image) {
                                return new AnimalImage($animal_image);
                            }, $animal['animal_images']);
                            if(isset($animal['veterinarian_reports'])) {
                                $animal['veterinarian_reports'] = [array_reduce($animal['veterinarian_reports'], function($carry, $item) {
                                    if(is_null($carry)) return new VeterinarianReport($item);
                                    return (strtotime($carry->getDate()) > strtotime($item['date'])) ? $carry : new VeterinarianReport($item);
                                }, )];
                            }
                            return new Animal($animal);
                        }, $breed['animals']);
                    return new Breed($breed);
                }, $habitat['breeds']);
            return new Habitat($habitat);
        }, $habitats);

        return $habitats;
    }
}