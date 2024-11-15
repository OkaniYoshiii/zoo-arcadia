<?php

namespace App\Tables;

use App\Entities\ScheduleHour;
use App\Traits\TableTrait;

class ScheduleHoursTable
{
    const TABLE_NAME = 'schedule_hours';
    const ENTITY = ['name' => 'ScheduleHour', 'class' => ScheduleHour::class];
    const PRIMARY_KEY = 'schedule_hour_id';
    const FIELDS = ['schedule_hour_id', 'hour'];

    use TableTrait;
}