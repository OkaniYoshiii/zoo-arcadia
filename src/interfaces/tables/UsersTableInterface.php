<?php

namespace App\Interfaces\Tables;

use App\Entity\User;

interface UsersTableInterface extends TableInterface {
    static public function create(User $user) : void;
    static public function update(User $user) : void;
    static public function isAlreadyRegistered(User $user) : bool;
    static public function getOneBy(string $property, $value) : User;
}