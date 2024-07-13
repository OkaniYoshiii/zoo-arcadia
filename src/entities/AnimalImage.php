<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;

class AnimalImage implements EntityInterface
{
    use EntityTrait;
    
    private ?int $animal_image_id;
    private ?string $name;
    private ?int $animal_id;

    private ?Animal $animal;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        $this->animal_image_id = $properties['animal_image_id'] ?? null;
        $this->name = $properties['name'] ?? null;
        $this->animal_id = $properties['animal_id'] ?? null;
        $this->animal = $properties['animal'] ?? null;
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