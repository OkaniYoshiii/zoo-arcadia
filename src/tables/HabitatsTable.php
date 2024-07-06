<?php

namespace App\Models\Table;

use App\Entity\Habitat;
use App\Trait\TableTrait;

class HabitatsTable
{
    const TABLE_NAME = 'habitats';
    const ENTITY = ['name' => 'Habitat', 'class' => Habitat::class];
    const PRIMARY_KEY = 'habitat_id';

    use TableTrait;
}