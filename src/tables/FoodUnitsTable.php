<?php

namespace App\Models\Table;

use App\Entity\FoodUnit;
use App\Trait\TableTrait;

class FoodUnitsTable
{
    const TABLE_NAME = 'food_units';
    const ENTITY = ['name' => 'FoodUnit', 'class' => FoodUnit::class];
    const PRIMARY_KEY = 'food_unit_id';

    use TableTrait;
}