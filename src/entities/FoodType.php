<?php

namespace App\Entity;

class FoodType
{
    private int $food_type_id;
    private string $name;

    /**
     * Get the value of food_type_id
     */ 
    public function getFoodTypeId()
    {
        return $this->food_type_id;
    }

    /**
     * Set the value of food_type_id
     *
     * @return  self
     */ 
    public function setFoodTypeId($food_type_id)
    {
        $this->food_type_id = $food_type_id;

        return $this;
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