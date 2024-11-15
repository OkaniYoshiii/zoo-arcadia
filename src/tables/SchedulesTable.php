<?php

namespace App\Tables;

use App\Entities\Schedule;
use App\Traits\TableTrait;

class SchedulesTable
{
    const TABLE_NAME = 'schedules';
    const ENTITY = ['name' => 'Schedule', 'class' => Schedule::class];
    const PRIMARY_KEY = 'schedule_id';
    const FIELDS = ['schedule_id', 'schedule_hour_id', 'week_day_id', 'is_opened'];

    use TableTrait;
}