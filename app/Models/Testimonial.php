<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Testimonial extends BaseModel
{
    protected $collection = 'testimonials';
    protected $fillable = ['*'];

    
    public static function getTestimonialByType($type) {

        if(!empty($type)){
            $result = self::where('slug',$type)->get()->toArray();
            return $result;
        }
    }
    
    
}

