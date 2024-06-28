<?php

namespace App\Entity;

class VeterinarianReport
{
    private int $veterinarian_report_id;
    private \Datetime $date;
    private string $detail;
    private int $food_quantity;
    private int $user_id;
    private int $food_type_id;
    private int $animal_id;

    /**
     * Get the value of veterinarian_report_id
     */ 
    public function getVeterinarianReportId()
    {
        return $this->veterinarian_report_id;
    }

    /**
     * Set the value of veterinarian_report_id
     *
     * @return  self
     */ 
    public function setVeterinarianReportId($veterinarian_report_id)
    {
        $this->veterinarian_report_id = $veterinarian_report_id;

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
}