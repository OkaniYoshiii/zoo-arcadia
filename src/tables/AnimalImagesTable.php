<?php

namespace App\Tables;

use App\Entities\AnimalImage;
use App\Traits\TableTrait;

class AnimalImagesTable
{
    const TABLE_NAME = 'animal_images';
    const ENTITY = ['name' => 'AnimalImage', 'class' => AnimalImage::class];
    const PRIMARY_KEY = 'animal_image_id';
    const FIELDS = ['animal_image_id', 'name', 'animal_id'];
    
    use TableTrait;
}