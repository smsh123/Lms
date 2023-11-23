<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Schedule extends BaseModel
{
    protected $collection = 'schedules';
    protected $fillable = ['*'];

    
    public static function getScheduleByCourseId($course_id) {

        if(!empty($course_id)){
            $result = self::where('course_id',$course_id)->get()->toArray();
            return $result;
        }
    }
    
    
}

