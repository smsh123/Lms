<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Faq extends BaseModel
{
    protected $collection = 'faqs';
    protected $fillable = ['*'];

}

