<?php

namespace App\Interfaces\Tables;

use App\Entity\Breed;

interface BreedsTableInterface extends TableInterface {
    static public function create(Breed $breed) : void;
    static public function update(Breed $breed) : void;
    static public function isAlreadyRegistered(Breed $breed) : bool;
    static public function getOneBy(string $property, $value) : Breed|false;
}