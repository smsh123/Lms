<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Section extends BaseModel
{
    protected $collection = 'sections';
    protected $fillable = ['*'];


    public static function getSectionBySlug($slug) {

        if(!empty($slug)){
            $result = self::where('slug',$slug)->where('is_public',1)->get()->toArray();
            return $result;

        }
    }

}

