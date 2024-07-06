<?php

namespace App\Models\Table;

use App\Entity\Breed;
use App\Trait\TableTrait;

class BreedsTable
{
    const TABLE_NAME = 'breeds';
    const ENTITY = ['name' => 'Breed', 'class' => Breed::class];
    const PRIMARY_KEY = 'breed_id';
    
    use TableTrait;
}