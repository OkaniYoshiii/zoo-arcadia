<?php

namespace App\Models\Table;

use App\Entity\AnimalImage;
use App\Trait\TableTrait;

class AnimalImagesTable
{
    const TABLE_NAME = 'animal_images';
    const ENTITY = ['name' => 'AnimalImage', 'class' => AnimalImage::class];
    
    use TableTrait;
}