<?php

namespace App\Entity;

class Animal
{
    private int $animal_id;
    private string $firstname;
    private string $state;
    private int $breed_id;
    private int $habitat_id;

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
     * Get the value of state
     */ 
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get the value of breed_id
     */ 
    public function getBreedId()
    {
        return $this->breed_id;
    }

    /**
     * Get the value of habitat_id
     */ 
    public function getHabitatId()
    {
        return $this->habitat_id;
    }
}