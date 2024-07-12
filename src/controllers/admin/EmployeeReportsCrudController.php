<?php

use App\Models\Table\AnimalsTable;
use App\Models\Table\EmployeeReportsTable;
use App\Models\Table\FoodTypesTable;
use App\Models\Table\FoodUnitsTable;

class EmployeeReportsCrudController
{
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
       
    }
}