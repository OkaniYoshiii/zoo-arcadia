<?php

namespace App\Models\Table;

use App\Entity\VeterinarianReport;
use App\Trait\TableTrait;

class VeterinarianReportsTable
{
    const TABLE_NAME = 'veterinarina_reports';
    const ENTITY = ['name' => 'VeterinarianReport', 'class' => VeterinarianReport::class];

    use TableTrait;
}