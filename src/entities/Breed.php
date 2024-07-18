<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;

class Breed implements EntityInterface
{
    use EntityTrait;
    
    private ?int $breed_id;
    private ?string $name;
    
    private array $animals;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        if(isset($properties['breed_id'])) $this->breed_id = $properties['breed_id'];
        if(isset($properties['name'])) $this->name = $properties['name'];

        if(isset($properties['animals'])) $this->animals = $properties['animals'];
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get the value of breed_id
     */ 
    public function getBreedId()
    {
        return $this->breed_id;
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
     * Get the value of animals
     */ 
    public function getAnimals()
    {
        return $this->animals;
    }

    /**
     * Set the value of animals
     *
     * @return  self
     */ 
    public function setAnimals($animals)
    {
        $this->animals = $animals;

        return $this;
    }
}