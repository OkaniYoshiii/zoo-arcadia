<?php

namespace App\Models\Table;

use App\Entity\EmployeeReport;
use App\Trait\TableTrait;

class EmployeeReportsTable
{
    const TABLE_NAME = 'employee_reports';
    const ENTITY = ['name' => 'EmployeeReport', 'class' => EmployeeReport::class];
    const PRIMARY_KEY = 'animal_image_id';
    
    use TableTrait;
}