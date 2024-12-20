<?php

namespace App\Entities;

use App\Interfaces\EntityInterface;
use App\Traits\EntityTrait;
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
    public function setDate(int|string|DateTime $date)
    {
        $format = 'd/m/Y';
        match(gettype($date)) 
        {
            'string' => $this->date = DateTime::createFromFormat($format, $date),
            'integer' => $this->date = (new DateTime())->setTimestamp($date),
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