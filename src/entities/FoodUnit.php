<?php

namespace App\Entity;

class FoodUnit
{
    private int $food_unit_id;
    private string $name;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        $this->setName($properties['name']);
    } 

    /**
     * Get the value of food_unit_id
     */ 
    public function getFoodUnitId()
    {
        return $this->food_unit_id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}