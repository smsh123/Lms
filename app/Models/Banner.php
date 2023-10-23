<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class Banner extends Authenticatable
{
    protected $collection = 'banners'; 

    protected $fillable = [
        'name',
        'image',
        'live_from',
        'live_till',
        'banner_type'
       
    ];

    // Additional model code, such as relationships and methods, can be defined here
}
