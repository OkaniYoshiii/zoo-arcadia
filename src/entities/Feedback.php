<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;
use DateTime;

class Feedback implements EntityInterface
{
    use EntityTrait;
    
    private int $feedback_id;
    private string $username;
    private string $content;
    private DateTime $date;
    private bool $is_validated;

    public function __construct(array $properties = null)
    {
        if(is_null($properties)) return;

        $this->setUsername($properties['username']);
        $this->setContent($properties['content']);
        $this->setDate($properties['date']);
        $this->setIsValidated($properties['is_validated']);
    }

    /**
     * Get the value of feedback_id
     */ 
    public function getFeedbackId()
    {
        return $this->feedback_id;
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
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate(string|DateTime $date)
    {
        match(gettype($date)) 
        {
            'string' => $this->date = DateTime::createFromFormat('d/m/Y', $date),
            'object' => $this->date = $date,
        };

        return $this;
    }

    /**
     * Get the value of is_validated
     */ 
    public function getIsValidated()
    {
        return $this->is_validated;
    }

    /**
     * Set the value of is_validated
     *
     * @return  self
     */ 
    public function setIsValidated($is_validated)
    {
        $this->is_validated = $is_validated;

        return $this;
    }
}