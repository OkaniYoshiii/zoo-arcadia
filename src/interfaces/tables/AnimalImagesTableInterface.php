<?php

namespace App\Interfaces\Tables;

use App\Entity\AnimalImage;

interface AnimalImagesTableInterface extends TableInterface {
    static public function create(AnimalImage $animalImage) : void;
    static public function update(AnimalImage $animalImage) : void;
    static public function isAlreadyRegistered(AnimalImage $animalImage) : bool;
    static public function getOneBy(string $property, $value) : AnimalImage|false;
}