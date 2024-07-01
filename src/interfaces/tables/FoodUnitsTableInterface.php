<?php

namespace App\Interfaces\Tables;

use App\Entity\FoodUnit;

interface FoodUnitsTableInterface extends TableInterface {
    static public function create(FoodUnit $foodUnit) : void;
    static public function update(FoodUnit $foodUnit) : void;
}