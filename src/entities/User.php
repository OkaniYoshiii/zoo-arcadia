<?php

namespace App\Entity;

class User 
{
    private int $user_id;
    private string $username;
    private string $firstname;
    private string $lastname;
    private string $role_name;

    /**
     * Get the value of user_id
     */ 
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of firstname
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of role_name
     */ 
    public function getRoleName()
    {
        return $this->role_name;
    }

    /**
     * Set the value of role_name
     *
     * @return  self
     */ 
    public function setRoleName($role_name)
    {
        $this->role_name = $role_name;

        return $this;
    }
}