<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;

class FoodUnit implements EntityInterface
{
    use EntityTrait;
    
    private int $food_unit_id;
    private string $name;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        if(isset($properties['food_unit_id'])) $this->food_unit_id = $properties['food_unit_id'];
        if(isset($properties['name'])) $this->name = $properties['name'];
    } 

    public function __toString()
    {
        return $this->name;
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