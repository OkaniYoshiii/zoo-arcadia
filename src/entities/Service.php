<?php

namespace App\Entities;

use App\Interfaces\EntityInterface;
use App\Traits\EntityTrait;

class Service implements EntityInterface
{
    use EntityTrait;
    
    private string $service_id;
    private string $name;
    private string $description;
    private string $img;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        if(isset($properties['_id'])) $this->service_id = (string) $properties['_id'];

        $this->setName($properties['name']);
        $this->setDescription($properties['description']);
        $this->setImg($properties['img']);
    }

    /**
     * Get the value of service_id
     */ 
    public function getServiceId()
    {
        return $this->service_id;
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
     * Get the value of img
     */ 
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */ 
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }
}