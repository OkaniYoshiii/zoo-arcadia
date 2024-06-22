<?php

namespace App\Interface;

interface TableInterface {
    static public function getAll() : array;
    static public function create(array $properties) : void;
    static public function update(array $properties) : void;
    static public function delete(int $id) : void;
    static public function isAlreadyRegistered(array $properties) : bool;
}