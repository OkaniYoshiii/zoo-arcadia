<?php

namespace App\Interfaces\Tables;

interface TableInterface {
    static public function getAll() : array;
    static public function delete(int $id) : void;
}