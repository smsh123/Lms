<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Category extends BaseModel
{
    protected $collection = 'categgories';
    protected $fillable = ['*'];


    public static function getCategoryBySlug($slug) {

        if(!empty($slug)){
            $result = self::where('slug',$slug)->get()->toArray();
            return $result;
        }
    }
}

