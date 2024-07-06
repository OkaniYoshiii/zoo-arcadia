<?php

namespace App\Trait;

trait EntityTrait
{
    public static function getClassProperties() : array
    {
        return array_keys(get_class_vars(self::class));
    }
}