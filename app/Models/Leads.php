<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Leads extends BaseModel
{
    protected $collection = 'leads';
    protected $fillable = ['*'];
}

