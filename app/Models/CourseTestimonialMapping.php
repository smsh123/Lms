<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class CourseTestimonialMapping extends BaseModel
{
    protected $collection = 'course_testimonial_mappings';
    protected $fillable = ['*'];

    
    public static function getTestimonialByCourseId($courseId) {

        if(!empty($courseId)){
            $result = self::where('course',$courseId)->get()->toArray();
            return $result;
        }
    }
    
    
}

