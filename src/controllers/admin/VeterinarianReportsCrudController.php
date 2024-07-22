<?php

use App\Entity\VeterinarianReport;
use App\Exception\FormInputException;
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
            default => throw new FormInputException('crudAction', FormInputException::INVALID_CRUD_ACTION),
        };
    }

    private function createEntity(array $formData)
    {
        if(!isset($formData['date'])) throw new FormInputException('date', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['detail'])) throw new FormInputException('detail', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['food_quantity'])) throw new FormInputException('food_quantity', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['food_type_id'])) throw new FormInputException('food_type_id', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['food_unit_id'])) throw new FormInputException('food_unit_id', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['animal_id'])) throw new FormInputException('animal_id', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['user_id'])) throw new FormInputException('user_id', FormInputException::UNDEFINED_VALUE);

        if(empty($formData['food_type_id'])) throw new FormInputException('food_type_id', FormInputException::EMPTY_VALUE);
        if(empty($formData['food_unit_id'])) throw new FormInputException('food_unit_id', FormInputException::EMPTY_VALUE);
        if(empty($formData['animal_id'])) throw new FormInputException('animal_id', FormInputException::EMPTY_VALUE);
        if(empty($formData['user_id'])) throw new FormInputException('user_id', FormInputException::EMPTY_VALUE);

        if(!strtotime($formData['date'])) throw new FormInputException('date', FormInputException::NOT_DATE);
        if(!is_string($formData['detail'])) throw new FormInputException('detail', FormInputException::NOT_STRING);
        if(!is_numeric($formData['food_quantity'])) throw new FormInputException('food_quantity', FormInputException::NOT_NUMERIC);
        if(!is_numeric($formData['food_type_id'])) throw new FormInputException('food_type_id', FormInputException::NOT_NUMERIC);
        if(!is_numeric($formData['food_unit_id'])) throw new FormInputException('food_unit_id', FormInputException::NOT_NUMERIC);
        if(!is_numeric($formData['animal_id'])) throw new FormInputException('animal_id', FormInputException::NOT_NUMERIC);
        if(!is_numeric($formData['user_id'])) throw new FormInputException('user_id', FormInputException::NOT_NUMERIC);
        if(empty($formData['date'])) throw new FormInputException('date', FormInputException::EMPTY_VALUE);

        if(empty($formData['detail'])) UserAlertsContainer::add('Le contenu du rapport est vide.');
        if(empty($formData['food_quantity'])) UserAlertsContainer::add('La quantité de nourriture spécifiée est vide.');

        $veterinarianReport = new VeterinarianReport($formData);
        if(VeterinarianReportsTable::isAlreadyRegistered($veterinarianReport)) UserAlertsContainer::add('Le rapport vétérinaire que vous venez de créer existe déjà.');

        if(UserAlertsContainer::hasAlerts()) return;

        VeterinarianReportsTable::create($veterinarianReport);
    }

    private function updateEntity(array $formData)
    {
        if(!isset($formData['veterinarian_report_id'])) throw new FormInputException('veterinarian_report_id', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['date'])) throw new FormInputException('date', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['detail'])) throw new FormInputException('detail', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['food_quantity'])) throw new FormInputException('food_quantity', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['food_type_id'])) throw new FormInputException('food_type_id', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['food_unit_id'])) throw new FormInputException('food_unit_id', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['animal_id'])) throw new FormInputException('animal_id', FormInputException::UNDEFINED_VALUE);
        if(!isset($formData['user_id'])) throw new FormInputException('user_id', FormInputException::UNDEFINED_VALUE);

        if(empty($formData['veterinarian_report_id'])) throw new FormInputException('veterinarian_report_id', FormInputException::EMPTY_VALUE);
        if(empty($formData['food_type_id'])) throw new FormInputException('food_type_id', FormInputException::EMPTY_VALUE);
        if(empty($formData['food_unit_id'])) throw new FormInputException('food_unit_id', FormInputException::EMPTY_VALUE);
        if(empty($formData['animal_id'])) throw new FormInputException('animal_id', FormInputException::EMPTY_VALUE);
        if(empty($formData['user_id'])) throw new FormInputException('user_id', FormInputException::EMPTY_VALUE);

        if(!is_numeric($formData['veterinarian_report_id'])) throw new FormInputException('veterinarian_report_id', FormInputException::NOT_NUMERIC);
        if(!strtotime($formData['date'])) throw new FormInputException('date', FormInputException::NOT_DATE);
        if(!is_string($formData['detail'])) throw new FormInputException('detail', FormInputException::NOT_STRING);
        if(!is_numeric($formData['food_quantity'])) throw new FormInputException('food_quantity', FormInputException::NOT_NUMERIC);
        if(!is_numeric($formData['food_type_id'])) throw new FormInputException('food_type_id', FormInputException::NOT_NUMERIC);
        if(!is_numeric($formData['food_unit_id'])) throw new FormInputException('food_unit_id', FormInputException::NOT_NUMERIC);
        if(!is_numeric($formData['animal_id'])) throw new FormInputException('animal_id', FormInputException::NOT_NUMERIC);
        if(!is_numeric($formData['user_id'])) throw new FormInputException('user_id', FormInputException::NOT_NUMERIC);
        if(empty($formData['date'])) throw new FormInputException('date', FormInputException::EMPTY_VALUE);

        if(empty($formData['detail'])) UserAlertsContainer::add('Le contenu du rapport est vide.');
        if(empty($formData['food_quantity'])) UserAlertsContainer::add('La quantité de nourriture spécifiée est vide.');

        if(UserAlertsContainer::hasAlerts()) return;
        
        $entity = new VeterinarianReport($formData);
        if(VeterinarianReportsTable::isAlreadyRegistered($entity)) UserAlertsContainer::add('Le rapport vétérinaire que vous venez de créer existe déjà.');
    
        VeterinarianReportsTable::update($entity);
    }

    private function deleteEntity(array $formData)
    {
        if(!isset($formData['veterinarian_report_id'])) throw new FormInputException('veterinarian_report_id', FormInputException::UNDEFINED_VALUE);
        if(empty($formData['veterinarian_report_id'])) throw new FormInputException('veterinarian_report_id', FormInputException::EMPTY_VALUE);
        if(!is_numeric($formData['veterinarian_report_id'])) throw new FormInputException('veterinarian_report_id', FormInputException::NOT_NUMERIC);

        VeterinarianReportsTable::delete($formData['veterinarian_report_id']);
    }
}