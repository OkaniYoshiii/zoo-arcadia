<?php

namespace App\Entity;

use App\Interface\EntityInterface;
use App\Trait\EntityTrait;

class WeekDay implements EntityInterface
{
    use EntityTrait;

    private int $week_day_id;
    private string $day;
    private array $schedules;

    public function __construct(array $properties = null)
    {
        if(!isset($properties)) return;

        if(isset($properties['week_day_id'])) $this->week_day_id = $properties['week_day_id'];
        $this->day = $properties['day'];
        if(isset($properties['schedules'])) {
            $this->schedules = array_map(function($schedule) { 
                $schedule['schedules_day'] = $this;
                $schedule['schedules_hour'] = new ScheduleHour($schedule['schedules_hour']);
                return new Schedule($schedule);
            }, $properties['schedules']);
        }
    }

    public function __toString()
    {
        return $this->day;
    }

    /**
     * Get the value of week_day_id
     */ 
    public function getWeek_day_id()
    {
        return $this->week_day_id;
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
     * Get the value of schedules
     */ 
    public function getSchedules()
    {
        return $this->schedules;
    }
}