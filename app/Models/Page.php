<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Page extends BaseModel
{
    protected $collection = 'pages';
    protected $fillable = ['*'];
}

