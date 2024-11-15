<?php

namespace App\Traits;

trait EntityTrait
{
    public static function getClassVars() : array
    {
        return get_class_vars(self::class);
    }

    public function getObjectVars() : array
    {
        return get_object_vars($this);
    }
}