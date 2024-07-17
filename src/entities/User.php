<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;

class User implements EntityInterface
{
    use EntityTrait;
    
    private int $user_id;
    private string $username;
    private string $firstname;
    private string $lastname;
    private string $pwd;
    private string $role_id;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        if(isset($properties['user_id'])) $this->user_id = $properties['user_id'];
        if(isset($properties['username'])) $this->username = $properties['username'];
        if(isset($properties['firstname'])) $this->firstname = $properties['firstname'];
        if(isset($properties['lastname'])) $this->lastname = $properties['lastname'];
        if(isset($properties['pwd'])) $this->pwd = $properties['pwd'];
        if(isset($properties['role_id'])) $this->role_id = $properties['role_id'];
    }

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
     * Get the value of pwd
     */ 
    public function getPassword()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */ 
    public function setPassword($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get the value of role_id
     */ 
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * Set the value of role_id
     *
     * @return  self
     */ 
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;

        return $this;
    }
}