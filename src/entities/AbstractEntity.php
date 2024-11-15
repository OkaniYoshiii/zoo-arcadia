<?php

namespace App\Entities;

abstract class AbstractEntity 
{
    public function getClassProperties() : array
    {
        return array_keys(get_class_vars($this::class));
    }
}