<?php

namespace App\Entity;

class Role
{
    private int $role_id;
    private string $name;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;
        
        $this->setName($properties['name']);
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