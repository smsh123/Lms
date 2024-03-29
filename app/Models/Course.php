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
    public static function getCourseByType($type) {

        if(!empty($type)){
            $result = self::where('course_type',$type)->where('is_public',1)->get()->toArray();
            return $result;
        }
    }
    public static function getActiveCourses() {

        $result = self::where('is_public', 1)->get()->toArray();
        return $result;

    }
}

