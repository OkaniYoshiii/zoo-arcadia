<?php

namespace App\Models\Table;

use App\Entity\HabitatImage;
use App\Trait\TableTrait;

class HabitatImagesTable
{
    const TABLE_NAME = 'habitat_images';
    const ENTITY = ['name' => 'HabitatImage', 'class' => HabitatImage::class];
    const PRIMARY_KEY = 'habitat_image_id';
    const FIELDS = ['habitat_image_id', 'name', 'habitat_id'];

    use TableTrait;
}