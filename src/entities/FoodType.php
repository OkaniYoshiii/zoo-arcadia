<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;

class FoodType implements EntityInterface
{
    use EntityTrait;
    
    private int $food_type_id;
    private string $name;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        $this->setName($properties['name']);
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get the value of food_type_id
     */ 
    public function getFoodTypeId()
    {
        return $this->food_type_id;
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