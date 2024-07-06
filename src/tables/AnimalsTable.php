<?php

namespace App\Models\Table;

use App\Entity\Animal;
use App\Trait\TableTrait;

class AnimalsTable
{
    const TABLE_NAME = 'animals';
    const ENTITY = ['name' => 'Animal', 'class' => Animal::class];
    
    use TableTrait;
}