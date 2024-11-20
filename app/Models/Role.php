<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];


    public function users_count()
    {
        return User::whereRoleIs($this->name)->count();
    }

    
}
