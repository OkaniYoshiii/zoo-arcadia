<?php

namespace App\Entity;

class AnimalImage 
{
    private int $animal_image_id;
    private string $name;
    private int $animal_id;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        $this->setName($properties['name']);
        $this->setAnimalId($properties['animal_id']);
    }

    /**
     * Get the value of animal_image_id
     */ 
    public function getAnimalImageId()
    {
        return $this->animal_image_id;
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