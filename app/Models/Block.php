<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Block extends BaseModel
{
    protected $collection = 'blocks';
    protected $fillable = ['*'];


    public static function getBlockBySlug($slug) {

        if(!empty($slug)){
            $result = self::where('slug',$slug)->get()->toArray();
            return $result;

        }
    }

}

