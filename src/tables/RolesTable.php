<?php

namespace App\Models\Table;

use App\Entity\Role;
use App\Trait\TableTrait;

class RolesTable
{
    const TABLE_NAME = 'roles';
    const ENTITY = ['name' => 'Role', 'class' => Role::class];
    const PRIMARY_KEY = 'role_id';

    use TableTrait;
}