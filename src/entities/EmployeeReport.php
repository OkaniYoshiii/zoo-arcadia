<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;
use DateTime;

class EmployeeReport implements EntityInterface
{
    use EntityTrait;
    
    private int $employee_report_id;
    private DateTime $date;
    private int $food_quantity;
    private int $food_type_id;
    private int $food_unit_id;
    private int $animal_id;

    private ?FoodType $food_type;
    private ?FoodUnit $food_unit;
    private ?Animal $animal;

    public function __construct(array $properties)
    {
        $this->employee_report_id = $properties['employee_report_id'];
        $this->date = $properties['date'];
        $this->food_quantity = $properties['food_quantity'];
        $this->food_type_id = $properties['food_type_id'];
        $this->animal_id = $properties['animal_id'];

        $this->food_type = $properties['food_type'];
        $this->food_unit = $properties['food_unit'];
        $this->animal = $properties['animal'];
    }

    /**
     * Get the value of employee_report_id
     */ 
    public function getEmployeeReportId()
    {
        return $this->employee_report_id;
    }

    /**
     * Set the value of employee_report_id
     *
     * @return  self
     */ 
    public function setEmployeeReportId($employee_report_id)
    {
        $this->employee_report_id = $employee_report_id;

        return $this;
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
}