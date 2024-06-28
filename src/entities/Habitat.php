<?php

namespace App\Entity;

class Habitat
{
    private int $habitat_id;
    private string $name;
    private string $description;
    private string|null $veterinarian_comments;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        $this->setName($properties['name']);
        $this->setDescription($properties['description']);
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
    public function getVeterinarian_comments()
    {
        return $this->veterinarian_comments;
    }

    /**
     * Set the value of veterinarian_comments
     *
     * @return  self
     */ 
    public function setVeterinarian_comments($veterinarian_comments)
    {
        $this->veterinarian_comments = $veterinarian_comments;

        return $this;
    }
}