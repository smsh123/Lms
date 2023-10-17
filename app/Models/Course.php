<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Course extends Eloquent
{

    protected $collection = 'courses'; 

    protected $fillable = ['*'];
}
