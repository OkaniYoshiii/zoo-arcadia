<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;

class Breed implements EntityInterface
{
    use EntityTrait;
    
    private int $breed_id;
    private string $name;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        $this->setName($properties['name']);
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
}