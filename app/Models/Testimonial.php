<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Testimonial extends BaseModel
{
    protected $collection = 'testimonials';
    protected $fillable = ['*'];

    
    public static function getTestimonialByType($type) {

        if(!empty($type)){
            $result = self::where('type',$type)->where('is_public',1)->get()->toArray();
            return $result;
        }
    }    
    
}

