<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class CourseModuleMapping extends BaseModel
{
    protected $collection = 'course_module_mappings';
    protected $fillable = ['*'];

    
    public static function getModulesByCourseId($courseId) {

        if(!empty($courseId)){
            $result = self::where('course',$courseId)->get()->toArray();
            return $result;
        }
    }
    
    
}

