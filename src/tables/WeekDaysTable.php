<?php

namespace App\Models\Table;

use App\Entity\WeekDay;
use App\Trait\TableTrait;

class WeekDaysTable
{
    const TABLE_NAME = 'week_days';
    const ENTITY = ['name' => 'WeekDay', 'class' => WeekDay::class];
    const PRIMARY_KEY = 'week_day_id';
    const FIELDS = ['week_day_id', 'day'];

    use TableTrait;
}