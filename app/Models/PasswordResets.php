<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class PasswordResets extends Eloquent
{

    protected $collection = 'password_resets'; 

    protected $fillable = [
        'email',
        'token',
        'created_at'
    ];
}
