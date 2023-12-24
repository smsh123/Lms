<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Banner extends BaseModel
{

    protected $collection = 'banners';

    protected $fillable = ['*'];


    // Additional model code, such as relationships and methods, can be defined here
}
