<?php

namespace App\Tables;

use App\Entities\FoodType;
use App\Traits\TableTrait;

class FoodTypesTable
{
    const TABLE_NAME = 'food_types';
    const ENTITY = ['name' => 'FoodType', 'class' => FoodType::class];
    const PRIMARY_KEY = 'food_type_id';
    
    use TableTrait;
}