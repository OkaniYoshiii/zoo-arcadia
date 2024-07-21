<?php

use App\Entity\EmployeeReport;
use App\Exception\UserInputException;
use App\Models\Table\AnimalsTable;
use App\Models\Table\EmployeeReportsTable;
use App\Models\Table\FoodTypesTable;
use App\Models\Table\FoodUnitsTable;

class EmployeeReportsCrudController
{
    private static array $formData;

    public function getVariables() : array
    {
        $foodTypes = FoodTypesTable::getAll();
        $foodUnits = FoodUnitsTable::getAll();
        $animals = AnimalsTable::getAllWithJoins();
        $employeeReports = EmployeeReportsTable::getAllWithJoins();
        return [
            'employeeReports' => $employeeReports,
            'animals' => $animals,
            'foodUnits' => $foodUnits,
            'foodTypes' => $foodTypes,
        ];
    }

    public function processFormData() : void
    {
        if(isset($_POST['employee_report_id'])) self::$formData['employee_report_id'] = $_POST['employee_report_id'];
        if(isset($_POST['animal_id'])) self::$formData['animal_id'] = $_POST['animal_id'];
        if(isset($_POST['food_quantity'])) self::$formData['food_quantity'] = $_POST['food_quantity'];
        if(isset($_POST['food_unit_id'])) self::$formData['food_unit_id'] = $_POST['food_unit_id'];
        if(isset($_POST['food_type_id'])) self::$formData['food_type_id'] = $_POST['food_type_id'];
        if(isset($_POST['date'])) self::$formData['date'] = $_POST['date'];

        match($_POST['crudAction']) {
            'CREATE' => $this->createReport(),
            'UPDATE' => $this->updateReport(),
            'DELETE' => $this->deleteReport(),
            default => throw new FormInputException('crudAction', 'value must be either CREATE, UPDATE or DELETE')
        };     
    }

    private function createReport() : void
    {
        if(!isset(self::$formData['animal_id'])) throw new FormInputException('animal_id', 'value is undefined');
        if(!isset(self::$formData['food_quantity'])) throw new FormInputException('food_quantity', 'value is undefined');
        if(!isset(self::$formData['food_unit_id'])) throw new FormInputException('food_unit_id', 'value is undefined');
        if(!isset(self::$formData['food_type_id'])) throw new FormInputException('food_type_id', 'value is undefined');
        if(!isset(self::$formData['date'])) throw new FormInputException('date', 'value is undefined');
        if(empty(self::$formData['animal_id'])) throw new FormInputException('animal_id', 'value is empty');
        if(empty(self::$formData['food_unit_id'])) throw new FormInputException('food_unit_id', 'value is empty');
        if(empty(self::$formData['food_type_id'])) throw new FormInputException('food_type_id', 'value is empty');
        if(!is_numeric(self::$formData['animal_id'])) throw new FormInputException('name', 'integer');
        if(!is_numeric(self::$formData['food_unit_id'])) throw new FormInputException('food_quantity', 'integer');
        if(!is_numeric(self::$formData['food_type_id'])) throw new FormInputException('food_unit_id', 'integer');

        if(empty(self::$formData['food_quantity'])) throw new UserInputException('food_quantity', 'value is empty');
        if(empty(self::$formData['date'])) throw new UserInputException('date', 'value is empty');
        if(!is_numeric(self::$formData['food_quantity'])) throw new UserInputException('food_type_id', 'value is not an integer');
        if(!strtotime(self::$formData['date'])) throw new UserInputException('date', 'value is not a date');

        if(strtotime(self::$formData['date']) > strtotime('now')) throw new UserInputException('date', 'value is greater than actual date');

        self::$formData['date'] = date('Y-m-d', strtotime(self::$formData['date']));

        $employeeReport = new EmployeeReport(self::$formData);

        if(EmployeeReportsTable::isAlreadyRegistered($employeeReport)) throw new UserInputException(null, 'EmployeeReport has already been registered');
        
        EmployeeReportsTable::create($employeeReport);
    }

    private function updateReport() : void
    {
        if(!isset(self::$formData['employee_report_id'])) throw new FormInputException('employee_report_id', 'value is undefined');
        if(!isset(self::$formData['animal_id'])) throw new FormInputException('animal_id', 'value is undefined');
        if(!isset(self::$formData['food_quantity'])) throw new FormInputException('food_quantity', 'value is undefined');
        if(!isset(self::$formData['food_unit_id'])) throw new FormInputException('food_unit_id', 'value is undefined');
        if(!isset(self::$formData['food_type_id'])) throw new FormInputException('food_type_id', 'value is undefined');
        if(!isset(self::$formData['date'])) throw new FormInputException('date', 'value is undefined');
        if(empty(self::$formData['employee_report_id'])) throw new FormInputException('employee_report_id', 'value is empty');
        if(empty(self::$formData['animal_id'])) throw new FormInputException('animal_id', 'value is empty');
        if(empty(self::$formData['food_unit_id'])) throw new FormInputException('food_unit_id', 'value is empty');
        if(empty(self::$formData['food_type_id'])) throw new FormInputException('food_type_id', 'value is empty');

        if(empty(self::$formData['food_quantity'])) throw new UserInputException('food_quantity', 'value is empty');
        if(empty(self::$formData['date'])) throw new UserInputException('date', 'value is empty');

        if(!is_numeric(self::$formData['employee_report_id'])) throw new FormInputException('employee_report_id', 'value is not numeric');
        if(!is_numeric(self::$formData['animal_id'])) throw new FormInputException('animal_id', 'value is not numeric');
        if(!is_numeric(self::$formData['food_unit_id'])) throw new FormInputException('food_unit_id', 'value is not numeric');
        if(!is_numeric(self::$formData['food_type_id'])) throw new FormInputException('food_type_id', 'value is not numeric');

        if(!is_numeric(self::$formData['food_quantity'])) throw new UserInputException('food_quantity', 'value is not a numeric stirng');
        if(!strtotime(self::$formData['date'])) throw new UserInputException('date', 'value is not a date');

        if(strtotime(self::$formData['date']) > strtotime('now')) throw new UserInputException('date', 'value cannot be greater than actual date');

        self::$formData['date'] = date('Y-m-d', strtotime(self::$formData['date']));

        $employeeReport = new EmployeeReport(self::$formData);

        if(EmployeeReportsTable::isAlreadyRegistered($employeeReport)) throw new UserInputException(null, 'User is aleady registered');
        
        EmployeeReportsTable::update($employeeReport);
    }

    private function deleteReport() : void
    {
        if(!isset(self::$formData['employee_report_id'])) throw new FormInputException('employee_report_id', 'value is undefined');
        if(empty(self::$formData['employee_report_id'])) throw new FormInputException('employee_report_id', 'value is empty');
        if(!is_numeric(self::$formData['employee_report_id'])) throw new FormInputException('employee_report_id', 'value is not a numeric string');

        EmployeeReportsTable::delete(self::$formData['employee_report_id']);
    }
}