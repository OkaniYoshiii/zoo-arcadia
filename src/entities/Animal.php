<?php

namespace App\Entity;

class Animal
{
    private int $animal_id;
    private string $firstname;
    private string $state;
    private int $breed_id;
    private int $habitat_id;
    private int|null $views;

    /**
     * Get the value of animal_id
     */ 
    public function getAnimalId()
    {
        return $this->animal_id;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set the value of state
     *
     * @return  self
     */ 
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get the value of breed_id
     */ 
    public function getBreedId()
    {
        return $this->breed_id;
    }

    /**
     * Set the value of breed_id
     *
     * @return  self
     */ 
    public function setBreedId($breed_id)
    {
        $this->breed_id = $breed_id;

        return $this;
    }

    /**
     * Get the value of habitat_id
     */ 
    public function getHabitatId()
    {
        return $this->habitat_id;
    }

    /**
     * Set the value of habitat_id
     *
     * @return  self
     */ 
    public function setHabitatId($habitat_id)
    {
        $this->habitat_id = $habitat_id;

        return $this;
    }

    /**
     * Get the value of views
     */ 
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set the value of views
     *
     * @return  self
     */ 
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }
}