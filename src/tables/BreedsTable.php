<?php

namespace App\Tables;

use App\Entities\Breed;
use App\Traits\TableTrait;

class BreedsTable
{
    const TABLE_NAME = 'breeds';
    const ENTITY = ['name' => 'Breed', 'class' => Breed::class];
    const PRIMARY_KEY = 'breed_id';
    
    use TableTrait;
}