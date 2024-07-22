<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;

class Role implements EntityInterface
{
    use EntityTrait;
    
    private int $role_id;
    private string $name;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;
        
        if(isset($properties['role_id'])) $this->role_id = $properties['role_id'];
        if(isset($properties['name'])) $this->name = $properties['name'];
    }

    /**
     * Get the value of role_id
     */ 
    public function getRoleId()
    {
        return $this->role_id;
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