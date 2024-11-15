<?php

namespace App\Interfaces;

interface EntityInterface
{
    public static function getClassVars() : array;
    public function getObjectVars() : array;
}