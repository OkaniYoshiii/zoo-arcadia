<?php

namespace App\Interfaces\Tables;

use App\Entity\Role;

interface RolesTableInterface extends TableInterface {
    static public function create(Role $role) : void;
    static public function update(Role $role) : void;
    static public function isAlreadyRegistered(Role $role) : bool;
    static public function getOneBy(string $property, $value) : Role|false;
}