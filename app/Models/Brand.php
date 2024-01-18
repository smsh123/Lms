<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Brand extends BaseModel
{
    protected $collection = 'brands';
    protected $fillable = ['*'];


    public static function getBrandsBySlug($slug) {

        if(!empty($slug)){
            $result = self::where('slug',$slug)->where('is_public',1)->get()->toArray();
            return $result;
        }
    }
}

