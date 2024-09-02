<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;

class Schedule implements EntityInterface
{
    use EntityTrait;

    private int $schedule_id;
    private int $schedule_hour_id;
    private int $week_day_id;
    private ScheduleHour $hour;
    private WeekDay $day;
    private bool $is_opened;

    public function __construct(array $properties = null)
    {
        if(!isset($properties)) return;

        if(isset($properties['schedule_id'])) $this->schedule_id = $properties['schedule_id'];
        if(isset($properties['schedule_hour_id'])) $this->schedule_hour_id = $properties['schedule_hour_id'];
        if(isset($properties['week_day_id'])) $this->week_day_id = $properties['week_day_id'];
        if(isset($properties['hour'])) $this->hour = $properties['hour'];
        if(isset($properties['day'])) $this->day = $properties['day'];
        if(isset($properties['is_opened'])) $this->is_opened = $properties['is_opened'];
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
        return $this->is_opened;
    }

    /**
     * Set the value of isOpen
     *
     * @return  self
     */ 
    public function setIsOpened($is_opened)
    {
        $this->is_opened = $is_opened;

        return $this;
    }
}