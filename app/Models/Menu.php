<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Menu extends BaseModel
{
    protected $collection = 'menus';
    protected $fillable = ['*'];
}

