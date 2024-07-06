<?php

namespace App\Models\Table;

use App\Entity\FoodType;
use App\Trait\TableTrait;

class FoodTypesTable
{
    const TABLE_NAME = 'food_types';
    const ENTITY = ['name' => 'FoodType', 'class' => FoodType::class];
    const PRIMARY_KEY = 'food_type_id';
    
    use TableTrait;
}