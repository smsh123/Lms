<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Category extends BaseModel
{
    protected $collection = 'categgories';
    protected $fillable = ['*'];


    public static function getCategoryBySlug($slug) {

        if(!empty($slug)){
            $result = self::where('slug',$slug)->where('is_public',1)->get()->toArray();
            return $result;
        }
    }
    public static function getActiveCategories() {
            $result = self::where('is_public', 1)->get()->toArray();
            return $result;
    }

    
}

