<?php

use App\Entity\EmployeeReport;
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
            default => throw new Exception('Form need to implement an hidden field named crudAction. Possible values are : CREATE, UPDATE, DELETE.')
        };     
    }

    private function createReport() : void
    {
        if(!isset(self::$formData['animal_id'])) throw new Exception('Form need to implements a field with an animal_id name.');
        if(!isset(self::$formData['food_quantity'])) throw new Exception('Form need to implements a field with an food_quantity name.');
        if(!isset(self::$formData['food_unit_id'])) throw new Exception('Form need to implements a field with an food_unit_id name.');
        if(!isset(self::$formData['food_type_id'])) throw new Exception('Form need to implements a field with an food_type_id name.');
        if(!isset(self::$formData['date'])) throw new Exception('Form need to implements a field with an date name.');

        if(empty(self::$formData['animal_id'])) throw new Exception('Form field name \'animal_id\' is empty.');
        if(empty(self::$formData['food_quantity'])) throw new Exception('Form field name \'food_quantity\' is empty.');
        if(empty(self::$formData['food_unit_id'])) throw new Exception('Form field name \'food_unit_id\' is empty.');
        if(empty(self::$formData['food_type_id'])) throw new Exception('Form field name \'food_type_id\' is empty.');
        if(empty(self::$formData['date'])) throw new Exception('Form field name \'date\' is empty.');

        if(!is_numeric(self::$formData['animal_id'])) throw new Exception('Form field name \'animal_id\' is not a numeric string.');
        if(!is_numeric(self::$formData['food_unit_id'])) throw new Exception('Form field name \'food_unit_id\' is not a numeric string.');
        if(!is_numeric(self::$formData['food_type_id'])) throw new Exception('Form field name \'food_type_id\' is not a numeric string.');
        if(!is_numeric(self::$formData['food_quantity'])) throw new Exception('Form field name \'food_quantity\' is not a numeric string.');
        if(!strtotime(self::$formData['date'])) throw new Exception('Form field name \'date\' is not a valid date.');

        if(strtotime(self::$formData['date']) > strtotime('now')) throw new Exception('Date cannot be greater than the actual date.');

        self::$formData['date'] = date('Y-m-d', strtotime(self::$formData['date']));

        $employeeReport = new EmployeeReport(self::$formData);

        if(EmployeeReportsTable::isAlreadyRegistered($employeeReport)) throw new Exception('This employeeReport has already been registered');
        
        EmployeeReportsTable::create($employeeReport);
    }

    private function updateReport() : void
    {
        if(!isset(self::$formData['employee_report_id'])) throw new Exception('Form need to implements a field with an employee_report_id name.');
        if(!isset(self::$formData['animal_id'])) throw new Exception('Form need to implements a field with an animal_id name.');
        if(!isset(self::$formData['food_quantity'])) throw new Exception('Form need to implements a field with an food_quantity name.');
        if(!isset(self::$formData['food_unit_id'])) throw new Exception('Form need to implements a field with an food_unit_id name.');
        if(!isset(self::$formData['food_type_id'])) throw new Exception('Form need to implements a field with an food_type_id name.');
        if(!isset(self::$formData['date'])) throw new Exception('Form need to implements a field with an date name.');

        if(empty(self::$formData['employee_report_id'])) throw new Exception('Form field name \'employee_report_id\' is empty.');
        if(empty(self::$formData['animal_id'])) throw new Exception('Form field name \'animal_id\' is empty.');
        if(empty(self::$formData['food_quantity'])) throw new Exception('Form field name \'food_quantity\' is empty.');
        if(empty(self::$formData['food_unit_id'])) throw new Exception('Form field name \'food_unit_id\' is empty.');
        if(empty(self::$formData['food_type_id'])) throw new Exception('Form field name \'food_type_id\' is empty.');
        if(empty(self::$formData['date'])) throw new Exception('Form field name \'date\' is empty.');

        if(!is_numeric(self::$formData['employee_report_id'])) throw new Exception('Form field name \'employee_report_id\' is not a numeric string.');
        if(!is_numeric(self::$formData['animal_id'])) throw new Exception('Form field name \'animal_id\' is not a numeric string.');
        if(!is_numeric(self::$formData['food_unit_id'])) throw new Exception('Form field name \'food_unit_id\' is not a numeric string.');
        if(!is_numeric(self::$formData['food_type_id'])) throw new Exception('Form field name \'food_type_id\' is not a numeric string.');
        if(!is_numeric(self::$formData['food_quantity'])) throw new Exception('Form field name \'food_quantity\' is not a numeric string.');
        if(!strtotime(self::$formData['date'])) throw new Exception('Form field name \'date\' is not a valid date.');

        if(strtotime(self::$formData['date']) > strtotime('now')) throw new Exception('Date cannot be greater than the actual date.');

        self::$formData['date'] = date('Y-m-d', strtotime(self::$formData['date']));

        $employeeReport = new EmployeeReport(self::$formData);

        if(EmployeeReportsTable::isAlreadyRegistered($employeeReport)) throw new Exception('This employeeReport has already been registered');
        
        EmployeeReportsTable::update($employeeReport);
    }

    private function deleteReport() : void
    {
        if(!isset(self::$formData['employee_report_id'])) throw new Exception('Form need to implements a field with an employee_report_id name.');
        if(empty(self::$formData['employee_report_id'])) throw new Exception('Form field name \'employee_report_id\' is empty.');
        if(!is_numeric(self::$formData['employee_report_id'])) throw new Exception('Form field name \'employee_report_id\' is not a numeric string.');

        EmployeeReportsTable::delete(self::$formData['employee_report_id']);
    }
}