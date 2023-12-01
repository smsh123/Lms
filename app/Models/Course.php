<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Course extends BaseModel
{
    protected $collection = 'courses';
    protected $fillable = ['*'];


    public static function getCourseBySlug($slug) {

        if(!empty($slug)){
            $result = self::where('slug',$slug)->get()->toArray();
            return $result;
        }
    }
}

