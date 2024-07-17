<?php

use App\Entity\VeterinarianReport;
use App\Interface\CrudControllerInterface;
use App\Models\Table\AnimalsTable;
use App\Models\Table\FoodTypesTable;
use App\Models\Table\FoodUnitsTable;
use App\Models\Table\VeterinarianReportsTable;

class VeterinarianReportsCrudController implements CrudControllerInterface
{
    public function getVariables()
    {
        $animals = AnimalsTable::getAllWithJoins();
        $foodTypes = FoodTypesTable::getAll();
        $foodUnits = FoodUnitsTable::getAll();
        $veterinarianReports = VeterinarianReportsTable::getAllWithJoins();
        return [
            'animals' => $animals,
            'foodTypes' => $foodTypes,
            'foodUnits' => $foodUnits,
            'veterinarianReports' => $veterinarianReports,
        ];
    }

    public function processFormData()
    {
        $formData = [
            'veterinarian_report_id' => $_POST['veterinarian_report_id'] ?? null,
            'date' => $_POST['date'] ?? null,
            'detail' => $_POST['detail'] ?? null,
            'food_quantity' => $_POST['food_quantity'] ?? null,
            'food_type_id' => $_POST['food_type_id'] ?? null,
            'food_unit_id' => $_POST['food_unit_id'] ?? null,
            'animal_id' => $_POST['animal_id'] ?? null,
            // Valeur par défaut en attendant le système de connexion avec le vrai id du user
            'user_id' => 1,
        ];

        match($_POST['crudAction']) {
            'CREATE' => $this->createEntity($formData),
            'UPDATE' => $this->updateEntity($formData),
            'DELETE' => $this->deleteEntity($formData),
            default => throw new Exception('A Crud Action need to be defined in the form to determine what this action is on the Entity. Possible values are : CREATE, UPDATE, DELETE.'),
        };
    }

    private function createEntity(array $formData)
    {
        if(!isset($formData['date'])) throw new Exception('date need to be specified in the form');
        if(!isset($formData['detail'])) throw new Exception('detail need to be specified in the form');
        if(!isset($formData['food_quantity'])) throw new Exception('food_quantity need to be specified in the form');
        if(!isset($formData['food_type_id'])) throw new Exception('food_type_id need to be specified in the form');
        if(!isset($formData['food_unit_id'])) throw new Exception('food_unit_id need to be specified in the form');
        if(!isset($formData['animal_id'])) throw new Exception('animal_id need to be specified in the form');
        if(!isset($formData['user_id'])) throw new Exception('user_id need to be specified in the form');

        if(empty($formData['date'])) throw new Exception('date is empty.');
        if(empty($formData['detail'])) throw new Exception('detail is empty.');
        if(empty($formData['food_quantity'])) throw new Exception('food_quantity is empty.');
        if(empty($formData['food_type_id'])) throw new Exception('food_type_id is empty.');
        if(empty($formData['food_unit_id'])) throw new Exception('food_unit_id is empty.');
        if(empty($formData['animal_id'])) throw new Exception('animal_id is empty.');
        if(empty($formData['user_id'])) throw new Exception('user_id is empty.');

        if(!strtotime($formData['date'])) throw new Exception('date is not a date.');
        if(!is_string($formData['detail'])) throw new Exception('detail is not a string.');
        if(!is_numeric($formData['food_quantity'])) throw new Exception('food_quantity is not numeric.');
        if(!is_numeric($formData['food_type_id'])) throw new Exception('food_type_id is not numeric.');
        if(!is_numeric($formData['food_unit_id'])) throw new Exception('food_unit_id is not numeric.');
        if(!is_numeric($formData['animal_id'])) throw new Exception('animal_id is not numeric.');
        if(!is_numeric($formData['user_id'])) throw new Exception('user_id is not numeric.');

        $veterinarianReport = new VeterinarianReport($formData);
        if(VeterinarianReportsTable::isAlreadyRegistered($veterinarianReport)) throw new Exception('VeterinarianReport is already registered.');

        VeterinarianReportsTable::create($veterinarianReport);
    }

    private function updateEntity(array $formData)
    {
        if(!isset($formData['veterinarian_report_id'])) throw new Exception('veterinarian_report_id need to be specified in the form');
        if(!isset($formData['date'])) throw new Exception('date need to be specified in the form');
        if(!isset($formData['detail'])) throw new Exception('detail need to be specified in the form');
        if(!isset($formData['food_quantity'])) throw new Exception('food_quantity need to be specified in the form');
        if(!isset($formData['food_type_id'])) throw new Exception('food_type_id need to be specified in the form');
        if(!isset($formData['food_unit_id'])) throw new Exception('food_unit_id need to be specified in the form');
        if(!isset($formData['animal_id'])) throw new Exception('animal_id need to be specified in the form');
        if(!isset($formData['user_id'])) throw new Exception('user_id need to be specified in the form');

        if(empty($formData['veterinarian_report_id'])) throw new Exception('veterinarian_report_id is empty.');
        if(empty($formData['date'])) throw new Exception('date is empty.');
        if(empty($formData['detail'])) throw new Exception('detail is empty.');
        if(empty($formData['food_quantity'])) throw new Exception('food_quantity is empty.');
        if(empty($formData['food_type_id'])) throw new Exception('food_type_id is empty.');
        if(empty($formData['food_unit_id'])) throw new Exception('food_unit_id is empty.');
        if(empty($formData['animal_id'])) throw new Exception('animal_id is empty.');
        if(empty($formData['user_id'])) throw new Exception('user_id is empty.');

        if(!is_numeric($formData['veterinarian_report_id'])) throw new Exception('veterinarian_report_id is not numeric.');
        if(!strtotime($formData['date'])) throw new Exception('date is not a date.');
        if(!is_string($formData['detail'])) throw new Exception('detail is not a string.');
        if(!is_numeric($formData['food_quantity'])) throw new Exception('food_quantity is not numeric.');
        if(!is_numeric($formData['food_type_id'])) throw new Exception('food_type_id is not numeric.');
        if(!is_numeric($formData['food_unit_id'])) throw new Exception('food_unit_id is not numeric.');
        if(!is_numeric($formData['animal_id'])) throw new Exception('animal_id is not numeric.');
        if(!is_numeric($formData['user_id'])) throw new Exception('user_id is not numeric.');
        
        $entity = new VeterinarianReport($formData);
        if(VeterinarianReportsTable::isAlreadyRegistered($entity)) throw new Exception('VeterinarianReport is already registered.');
    
        VeterinarianReportsTable::update($entity);
    }

    private function deleteEntity(array $formData)
    {
        if(!isset($formData['veterinarianReportId'])) throw new Exception('Veterinarian report ID need to be specified in the form');
        if(empty($formData['veterinarian_report_id'])) throw new Exception('veterinarian_report_id is empty.');
        if(!is_numeric($formData['veterinarian_report_id'])) throw new Exception('veterinarian_report_id is not numeric.');

        VeterinarianReportsTable::delete($formData['veterinarianReportId']);
    }
}