<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Blog extends BaseModel
{
    protected $collection = 'courses';
    protected $fillable = ['*'];
}

