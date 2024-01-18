<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Menu extends BaseModel
{
    protected $collection = 'menus';
    protected $fillable = ['*'];

    
    public static function getMenuBySlug($slug) {

        if(!empty($slug)){
            $result = self::where('slug',$slug)->where('is_public',1)->get()->toArray();
            return $result;
        }
    }
    
    
}

