<?php

namespace App\Entity;

use DateTime;

class Feedback 
{
    private int $feedback_id;
    private string $username;
    private string $content;
    private DateTime $date;
    private bool $is_validated;

    public function  __construct(array $properties)
    {
        foreach($properties as $key => $value)
        {
            match($key) {
                'date' => $this->date = DateTime::createFromFormat('d/m/Y', $value),
                '_id' => $this->feedback_id = $value,
                default => $this->{$key} = $value,
            };
        }
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
     * Get the value of content
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get the value of is_validated
     */ 
    public function getIsValidated()
    {
        return $this->is_validated;
    }
}