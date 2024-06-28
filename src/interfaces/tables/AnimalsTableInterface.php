<?php

namespace App\Interfaces\Tables;

use App\Entity\Animal;

interface AnimalsTableInterface extends TableInterface {
    static public function create(Animal $animal) : void;
    static public function update(Animal $animal) : void;
    static public function isAlreadyRegistered(Animal $animal) : bool;
}