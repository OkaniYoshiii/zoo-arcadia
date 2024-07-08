<?php

namespace App\Entity;

use App\Trait\EntityTrait;

class ScheduleHour
{
    use EntityTrait;

    private int $schedule_hour_id;
    private string $hour;
    private array $schedules;

    public function __construct(array $properties = null)
    {
        if(!isset($properties)) return;

        if(isset($properties['_id'])) $this->schedule_hour_id = $properties['_id'];
        $this->hour = $properties['hour'];
        if(isset($properties['schedules'])) {
            $this->schedules = array_map(function($schedule) { 
                $schedule['schedules_hour'] = $this;
                $schedule['schedules_day'] = new ScheduleDay($schedule['schedules_day']);
                return new Schedule($schedule);
            }, $properties['schedules']);
        }
    }

    public function __toString()
    {
        return $this->hour;
    }

    /**
     * Get the value of schedule_hour_id
     */ 
    public function getScheduleHourId()
    {
        return $this->schedule_hour_id;
    }

    /**
     * Get the value of hour
     */ 
    public function getHour()
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
     * Get the value of schedules
     */ 
    public function getSchedules()
    {
        return $this->schedules;
    }

  
}