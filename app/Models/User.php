<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    use Notifiable;
    protected $collection = 'users'; 

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'avatar_image',
        'password'
       
    ];

    // Additional model code, such as relationships and methods, can be defined here
}
