<?php

namespace App\Interfaces\Tables;

use App\Entity\FoodType;

interface FoodTypesTableInterface extends TableInterface {
    static public function create(FoodType $foodType) : void;
    static public function update(FoodType $foodType) : void;
    static public function isAlreadyRegistered(FoodType $foodType) : bool;
    static public function getOneBy(string $property, $value) : FoodType|false;
    static public function getIdOf(FoodType $foodType) : int|false;
}