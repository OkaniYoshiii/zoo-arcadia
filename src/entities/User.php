<?php

namespace App\Entity;

class User 
{
    private int $user_id;
    private string $username;
    private string $firstname;
    private string $lastname;
    private string $password;
    private string $role_id;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        $this->setUsername($properties['username']);
        $this->setPassword($properties['pwd']);
        $this->setFirstname($properties['firstname']);
        $this->setLastname($properties['lastname']);
        $this->setRoleId($properties['role_id']);
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
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

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