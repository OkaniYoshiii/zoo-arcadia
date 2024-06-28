<?php

namespace App\Entity;

class Role
{
    private int $role_id;
    private string $name;

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of id
     */ 
    public function getRoleId()
    {
        return $this->role_id;
    }
}