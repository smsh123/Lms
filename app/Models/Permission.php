<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Permission extends BaseModel
{
    protected $collection = 'permissions';
    protected $fillable = ['*'];
}

