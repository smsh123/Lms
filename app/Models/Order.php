<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Order extends BaseModel
{
    protected $collection = 'orders';
    protected $fillable = ['*'];
}

