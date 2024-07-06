<?php

namespace App\Models\Table;

use App\Entity\User;
use App\Trait\TableTrait;

class UsersTable
{
    const TABLE_NAME = 'users';
    const ENTITY = ['name' => 'User', 'class' => User::class];

    use TableTrait;
}