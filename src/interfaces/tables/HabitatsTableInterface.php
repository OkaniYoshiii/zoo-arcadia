<?php

namespace App\Interfaces\Tables;

use App\Entity\Habitat;

interface HabitatsTableInterface extends TableInterface {
    static public function create(Habitat $habitat) : void;
    static public function update(Habitat $habitat) : void;
    static public function isAlreadyRegistered(Habitat $habitat) : bool;
    static public function getOneBy(string $property, $value) : Habitat|false;
}