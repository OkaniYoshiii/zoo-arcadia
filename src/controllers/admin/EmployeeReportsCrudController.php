<?php

use App\Models\Table\AnimalsTable;
use App\Models\Table\EmployeeReportsTable;
use App\Models\Table\FoodTypesTable;

class EmployeeReportsCrudController
{
    public function getVariables() : array
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
            ]
            
        ];
        $employeeReports = EmployeeReportsTable::getAllWithJoins(...$joins);
        return [
            'employeeReports' => $employeeReports,
        ];
    }

    public function processFormData() : void
    {
       
    }
}