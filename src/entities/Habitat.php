<?php

namespace App\Entities;

use App\Interfaces\EntityInterface;
use App\Traits\EntityTrait;

class Habitat implements EntityInterface
{
    use EntityTrait;
    
    private int $habitat_id;
    private string $name;
    private string $description;
    private string $veterinarian_comments;

    private HabitatImage $habitat_image;
    private array $breeds;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        if(isset($properties['habitat_id'])) $this->habitat_id = $properties['habitat_id'];
        if(isset($properties['name'])) $this->name = $properties['name'];
        if(isset($properties['description'])) $this->description = $properties['description'];
        if(isset($properties['veterinarian_comments'])) $this->veterinarian_comments = $properties['veterinarian_comments'];

        if(isset($properties['habitat_image'])) $this->habitat_image = $properties['habitat_image'];
        if(isset($properties['breeds'])) $this->breeds = $properties['breeds'];
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

    /**
     * Get the value of habitat_images
     */ 
    public function getHabitatImage()
    {
        return $this->habitat_image;
    }

    /**
     * Set the value of habitat_images
     *
     * @return  self
     */ 
    public function setHabitatImage($habitat_image)
    {
        $this->habitat_image = $habitat_image;

        return $this;
    }

    /**
     * Get the value of breeds
     */ 
    public function getBreeds()
    {
        return $this->breeds;
    }

    /**
     * Set the value of breeds
     *
     * @return  self
     */ 
    public function setBreeds($breeds)
    {
        $this->breeds = $breeds;

        return $this;
    }
}