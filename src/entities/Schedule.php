<?php

namespace App\Entity;

use App\Trait\EntityTrait;

class Schedule 
{
    use EntityTrait;

    private int $schedule_id;
    private ScheduleHour $hour;
    private ScheduleDay $day;
    private bool $is_open;

    public function __construct(array $properties = null)
    {
        if(!isset($properties)) return;

        if(isset($properties['_id'])) $this->schedule_id = $properties['_id'];
        $this->hour = $properties['schedules_hour'];
        $this->day = $properties['schedules_day'];
        $this->is_open = $properties['isOpen'];
    }

     /**
     * Get the value of schedule_id
     */ 
    public function getScheduleId()
    {
        return $this->schedule_id;
    }

    /**
     * Set the value of schedule_id
     *
     * @return  self
     */ 
    public function setScheduleId($schedule_id)
    {
        $this->schedule_id = $schedule_id;

        return $this;
    }

    /**
     * Get the value of hour
     */ 
    public function getHours()
    {
        return $this->hour;
    }

    /**
     * Set the value of hour
     *
     * @return  self
     */ 
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get the value of day
     */ 
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set the value of day
     *
     * @return  self
     */ 
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get the value of is_open
     */ 
    public function getIsOpen()
    {
        return $this->is_open;
    }

    /**
     * Set the value of isOpen
     *
     * @return  self
     */ 
    public function setIsOpen($is_open)
    {
        $this->is_open = $is_open;

        return $this;
    }
}