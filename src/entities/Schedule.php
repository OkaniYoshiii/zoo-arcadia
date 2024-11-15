<?php

namespace App\Entities;

use App\Interfaces\EntityInterface;
use App\Tables\ScheduleHoursTable;
use App\Tables\WeekDaysTable;
use App\Traits\EntityTrait;

class Schedule implements EntityInterface
{
    use EntityTrait;

    private int $schedule_id;
    private int $schedule_hour_id;
    private int $week_day_id;
    private ScheduleHour $scheduleHour;
    private WeekDay $weekDay;
    private bool $is_opened;

    public function __construct(array $properties = null)
    {
        if(!isset($properties)) return;

        if(isset($properties['schedule_id'])) $this->schedule_id = $properties['schedule_id'];
        if(isset($properties['schedule_hour_id'])) $this->schedule_hour_id = $properties['schedule_hour_id'];
        if(isset($properties['week_day_id'])) $this->week_day_id = $properties['week_day_id'];
        if(isset($properties['hour'])) $this->hour = $properties['hour'];
        if(isset($properties['day'])) $this->day = $properties['day'];
        if(isset($properties['is_opened'])) $this->is_opened = (bool) $properties['is_opened'];
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
     * Get the value of is_open
     */ 
    public function getIsOpened()
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

    /**
     * Get the value of schedule_hour_id
     */ 
    public function getScheduleHourId()
    {

        return $this->schedule_hour_id;
    }

    /**
     * Set the value of schedule_hour_id
     *
     * @return  self
     */ 
    public function setScheduleHourId($schedule_hour_id)
    {
        $this->schedule_hour_id = $schedule_hour_id;

        return $this;
    }

    /**
     * Get the value of week_day_id
     */ 
    public function getWeekDayId()
    {
        return $this->week_day_id;
    }

    /**
     * Set the value of week_day_id
     *
     * @return  self
     */ 
    public function setWeekDayId($week_day_id)
    {
        $this->week_day_id = $week_day_id;

        return $this;
    }

    /**
     * Get the value of scheduleHour
     */ 
    public function getScheduleHour()
    {
        if(!isset($this->scheduleHour)) $this->setScheduleHour(ScheduleHoursTable::findById($this->schedule_hour_id));

        return $this->scheduleHour;
    }

    /**
     * Set the value of scheduleHour
     *
     * @return  self
     */ 
    public function setScheduleHour($scheduleHour)
    {
        $this->scheduleHour = $scheduleHour;

        return $this;
    }

    /**
     * Get the value of weekDay
     */ 
    public function getWeekDay()
    {
        if(!isset($this->weekDay)) $this->setWeekDay(WeekDaysTable::findById($this->week_day_id));

        return $this->weekDay;
    }

    /**
     * Set the value of weekDay
     *
     * @return  self
     */ 
    public function setWeekDay($weekDay)
    {
        $this->weekDay = $weekDay;

        return $this;
    }
}