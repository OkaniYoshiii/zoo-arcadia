<?php

namespace App\Models\Table;

use App\Entity\VeterinarianReport;
use App\Trait\TableTrait;

class VeterinarianReportsTable
{
    const TABLE_NAME = 'veterinarian_reports';
    const ENTITY = ['name' => 'VeterinarianReport', 'class' => VeterinarianReport::class];
    const PRIMARY_KEY = 'veterinarian_report_id';

    use TableTrait;
}