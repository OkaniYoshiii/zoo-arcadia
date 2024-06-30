<?php

namespace App\Interfaces\Tables;

use App\Entity\HabitatImage;

interface HabitatImagesTableInterface extends TableInterface {
    static public function create(HabitatImage $animal) : void;
    static public function update(HabitatImage $animal) : void;
    static public function isAlreadyRegistered(HabitatImage $animal) : bool;
    static public function getOneBy(string $property, $value) : HabitatImage|false;
    static public function getIdOf(HabitatImage $habitatImage) : int|false;
}