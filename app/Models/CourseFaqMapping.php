<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class CourseFaqMapping extends BaseModel
{
    protected $collection = 'course_faq_mappings';
    protected $fillable = ['*'];

    
    public static function getFaqByCourseId($courseId) {

        if(!empty($courseId)){
            $result = self::where('course',$courseId)->get()->toArray();
            return $result;
        }
    }
    
    
}

