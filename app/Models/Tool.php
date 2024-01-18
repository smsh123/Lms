<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Tool extends BaseModel
{
    protected $collection = 'tools';
    protected $fillable = ['*'];


    public static function getToolsBySlug($slug) {

        if(!empty($slug)){
            $result = self::where('slug',$slug)->where('is_public',1)->get()->toArray();
            return $result;
        }
    }
}

