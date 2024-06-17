<?php

use App\Entity\Role;

class User 
{
    private int $user_id;
    private string $username;
    private string $firstname;
    private string $lastname;
    private string $role_name;

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Get the value of role_name
     */ 
    public function getRoleName()
    {
        return $this->role_name;
    }

    /**
     * Get the value of id
     */ 
    public function getUserId()
    {
        return $this->user_id;
    }
}