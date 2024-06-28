<?php

namespace App\Entity;

class Breed 
{
    private int $breed_id;
    private string $name;

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