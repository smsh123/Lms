<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $collection = 'users'; 

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Additional model code, such as relationships and methods, can be defined here
}
