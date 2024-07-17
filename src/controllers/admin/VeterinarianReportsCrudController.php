<?php

use App\Entity\VeterinarianReport;
use App\Interface\CrudControllerInterface;
use App\Models\Table\AnimalsTable;
use App\Models\Table\FoodTypesTable;
use App\Models\Table\FoodUnitsTable;
use App\Models\Table\VeterinarianReportsTable;

class VeterinarianReportsCrudController implements CrudControllerInterface
{
    private static array $formInputErrors = [];
    private static array $formData;

    public function getVariables()
    {
        $animals = AnimalsTable::getAllWithJoins();
        $foodTypes = FoodTypesTable::getAll();
        $foodUnits = FoodUnitsTable::getAll();
        $veterinarianReports = VeterinarianReportsTable::getAllWithJoins();
        return [
            'formErrors' => self::$formInputErrors,
            'animals' => $animals,
            'foodTypes' => $foodTypes,
            'foodUnits' => $foodUnits,
            'veterinarianReports' => $veterinarianReports,
        ];
    }

    public function processFormData()
    {
        self::$formData = [
            'veterinarianReportId' => $_POST['veterinarianReportId'] ?? null,
            'date' => $_POST['date'] ?? null,
            'detail' => $_POST['detail'] ?? null,
            'foodQuantity' => $_POST['foodQuantity'] ?? null,
            'animalId' => $_POST['animalId'] ?? null,
            'foodTypeId' => $_POST['foodTypeId'] ?? null,
        ];

        match($_POST['crudAction']) {
            'CREATE' => self::createEntity(),
            'UPDATE' => self::updateEntity(),
            'DELETE' => self::deleteEntity(),
            default => throw new Exception('A Crud Action need to be defined in the form to determine what this action is on the Entity. Possible values are : CREATE, UPDATE, DELETE.'),
        };
    }

    private static function createEntity()
    {
        if(is_null(self::$formData['date'])) throw new Exception('Date need to be specified in the form');
        if(is_null(self::$formData['detail'])) throw new Exception('Detail need to be specified in the form');
        if(is_null(self::$formData['foodQuantity'])) throw new Exception('Food quantity need to be specified in the form');
        if(is_null(self::$formData['animalId'])) throw new Exception('Animal ID need to be specified in the form');
        if(is_null(self::$formData['foodTypeId'])) throw new Exception('Food type ID need to be specified in the form');

        if(empty(self::$formData['date'])) self::$formInputErrors[] = 'Le nom d\'utilisateur renseigné est vide';
        if(empty(self::$formData['detail'])) self::$formInputErrors[] = 'Le prénom de l\'utilisateur est vide';
        if(empty(self::$formData['foodQuantity'])) self::$formInputErrors[] = 'Le nom de l\'utilisateur est vide';
        if(empty(self::$formData['animalId'])) self::$formInputErrors[] = 'Le mot de passe renseigné est vide';
        if(empty(self::$formData['foodTypeId'])) self::$formInputErrors[] = 'Le mot de passe renseigné est vide';

        $entity = new VeterinarianReport(self::$formData);
        if(VeterinarianReportsTable::isAlreadyRegistered($entity)) self::$formInputErrors[] = 'L\'utilisateur renseigné existe déjà !';

        if(!empty(self::$formInputErrors)) return;

        VeterinarianReportsTable::create($entity);
    }

    private static function updateEntity()
    {
        if(is_null(self::$formData['veterinarian_report_id'])) throw new Exception('Veterinarian report ID need to be specified in the form');
        if(is_null(self::$formData['date'])) throw new Exception('Date need to be specified in the form');
        if(is_null(self::$formData['detail'])) throw new Exception('Detail need to be specified in the form');
        if(is_null(self::$formData['foodQuantity'])) throw new Exception('Food quantity need to be specified in the form');
        if(is_null(self::$formData['animalId'])) throw new Exception('Animal ID need to be specified in the form');
        if(is_null(self::$formData['foodTypeId'])) throw new Exception('Food type ID need to be specified in the form');

        if(empty(self::$formData['date'])) self::$formInputErrors[] = 'Le nom d\'utilisateur renseigné est vide';
        if(empty(self::$formData['detail'])) self::$formInputErrors[] = 'Le prénom de l\'utilisateur est vide';
        if(empty(self::$formData['foodQuantity'])) self::$formInputErrors[] = 'Le nom de l\'utilisateur est vide';
        if(empty(self::$formData['animalId'])) self::$formInputErrors[] = 'Le mot de passe renseigné est vide';
        if(empty(self::$formData['foodTypeId'])) self::$formInputErrors[] = 'Le mot de passe renseigné est vide';
        
        $entity = new VeterinarianReport(self::$formData);
        if(VeterinarianReportsTable::isAlreadyRegistered($entity)) self::$formInputErrors[] = 'L\'utilisateur renseigné existe déjà !';
    
        VeterinarianReportsTable::update($entity);
    }

    private static function deleteEntity()
    {
        if(is_null(self::$formData['veterinarianReportId'])) throw new Exception('Veterinarian report ID need to be specified in the form');

        VeterinarianReportsTable::delete(self::$formData['veterinarianReportId']);
    }
}