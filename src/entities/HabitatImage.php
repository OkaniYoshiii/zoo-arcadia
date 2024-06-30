<?php

namespace App\Entity;

class HabitatImage
{
    private int $habitat_image_id;
    private string $name;
    private int $habitat_id;

    public function __construct(array $properties = null)
    {
        if($properties === null) return;

        $this->name = $properties['name'];    
        $this->habitat_id = $properties['habitat_id'];    
    }

    /**
     * Get the value of habitat_image_id
     */
    public function getHabitatImageId() : string
    {
        return $this->habitat_image_id;
    }

    /**
     * Get the value of name
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     * 
     * @return self
     */
    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of habitat_id
     */
    public function getHabitatId() : string
    {
        return $this->habitat_id;
    }

    /**
     * Set the value of habitat_id
     * 
     * @return self
     */
    public function setHabitatId(string $habitat_id) : self
    {
        $this->habitat_id = $habitat_id;

        return $this;
    }
}