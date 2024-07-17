<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;

class VeterinarianReport implements EntityInterface
{
    use EntityTrait;
    
    private int $veterinarian_report_id;
    private string $date;
    private string $detail;
    private int $food_quantity;
    private int $food_unit_id;
    private int $food_type_id;
    private int $user_id;
    private int $animal_id;

    private FoodType $food_type;
    private FoodUnit $food_unit;
    private Animal $animal;
    private User $user;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        if(isset($properties['veterinarian_report_id'])) $this->veterinarian_report_id = $properties['veterinarian_report_id'];
        if(isset($properties['date'])) $this->date = $properties['date'];
        if(isset($properties['detail'])) $this->detail = $properties['detail'];
        if(isset($properties['food_quantity'])) $this->food_quantity = $properties['food_quantity'];
        if(isset($properties['food_unit_id'])) $this->food_unit_id = $properties['food_unit_id'];
        if(isset($properties['food_type_id'])) $this->food_type_id = $properties['food_type_id'];
        if(isset($properties['user_id'])) $this->user_id = $properties['user_id'];
        if(isset($properties['user_id'])) $this->user_id = $properties['user_id'];
        if(isset($properties['animal_id'])) $this->animal_id = $properties['animal_id'];

        if(isset($properties['food_unit'])) $this->food_unit = $properties['food_unit'];
        if(isset($properties['food_type'])) $this->food_type = $properties['food_type'];
        if(isset($properties['animal'])) $this->animal = $properties['animal'];
        if(isset($properties['user'])) $this->user = $properties['user'];
    }

    /**
     * Get the value of veterinarian_report_id
     */ 
    public function getVeterinarianReportId()
    {
        return $this->veterinarian_report_id;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of detail
     */ 
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set the value of detail
     *
     * @return  self
     */ 
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get the value of food_quantity
     */ 
    public function getFoodQuantity()
    {
        return $this->food_quantity;
    }

    /**
     * Set the value of food_quantity
     *
     * @return  self
     */ 
    public function setFoodQuantity($food_quantity)
    {
        $this->food_quantity = $food_quantity;

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

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
     * Get the value of animal_id
     */ 
    public function getAnimalId()
    {
        return $this->animal_id;
    }

    /**
     * Set the value of animal_id
     *
     * @return  self
     */ 
    public function setAnimalId($animal_id)
    {
        $this->animal_id = $animal_id;

        return $this;
    }

    /**
     * Get the value of food_unit_id
     */ 
    public function getFoodUnitId()
    {
        return $this->food_unit_id;
    }

    /**
     * Set the value of food_unit_id
     *
     * @return  self
     */ 
    public function setFoodUnitId($food_unit_id)
    {
        $this->food_unit_id = $food_unit_id;

        return $this;
    }

    /**
     * Get the value of food_type
     */ 
    public function getFoodType()
    {
        return $this->food_type;
    }

    /**
     * Set the value of food_type
     *
     * @return  self
     */ 
    public function setFoodType($food_type)
    {
        $this->food_type = $food_type;

        return $this;
    }

    /**
     * Get the value of food_unit
     */ 
    public function getFoodUnit()
    {
        return $this->food_unit;
    }

    /**
     * Set the value of food_unit
     *
     * @return  self
     */ 
    public function setFoodUnit($food_unit)
    {
        $this->food_unit = $food_unit;

        return $this;
    }

    /**
     * Get the value of animal
     */ 
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * Set the value of animal
     *
     * @return  self
     */ 
    public function setAnimal($animal)
    {
        $this->animal = $animal;

        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
}