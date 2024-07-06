<?php

namespace App\Interface;

interface EntityInterface
{
    public static function getClassVars() : array;
    public function getObjectVars() : array;
}