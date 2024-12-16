<?php

namespace App\Models;

use App\Traits\TranslateTrait;
use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    // use Translatable trait to translate the columns 
    use TranslateTrait;

    public $guarded = [];

    protected $casts = [
        'display_name' => 'json',
        'description' => 'json',
    ];

    public function the_display_name($lang = null)
    {
        return $this->translateCol($this->display_name, $lang);
    }

    public function the_description($lang = null)
    {
        return $this->translateCol($this->description, $lang);
    }
}
