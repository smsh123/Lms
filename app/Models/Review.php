<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Review extends BaseModel
{
    protected $collection = 'reviews';
    protected $fillable = ['*'];

    
    public static function getReviewsByCourseSlug($slug) {
        if(!empty($slug)){
            $result = self::where('product',$slug)->where('is_public',1)->get()->toArray();
            return $result;
        }
    }

    public static function getReviewsByUserId($user_id) {
        if(!empty($user_id)){
            $result = self::where('user_id',$user_id)->where('is_public',1)->get()->toArray();
            return $result;
        }
    }
    
    
}

