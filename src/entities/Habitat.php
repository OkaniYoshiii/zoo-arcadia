<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;

class Habitat implements EntityInterface
{
    use EntityTrait;
    
    private ?int $habitat_id;
    private ?string $name;
    private ?string $description;
    private ?string $veterinarian_comments;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        $this->habitat_id = $properties['habitat_id'] ?? null;
        $this->name = $properties['name'] ?? null;
        $this->description = $properties['description'] ?? null;
        $this->veterinarian_comments = $properties['veterinarian_comments'] ?? null;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * Get the value of habitat_id
     */ 
    public function getHabitatId()
    {
        return $this->habitat_id;
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
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of veterinarian_comments
     */ 
    public function getVeterinarianComments()
    {
        return $this->veterinarian_comments;
    }

    /**
     * Set the value of veterinarian_comments
     *
     * @return  self
     */ 
    public function setVeterinarianComments($veterinarian_comments)
    {
        $this->veterinarian_comments = $veterinarian_comments;

        return $this;
    }
}