<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Module extends BaseModel
{
    protected $collection = 'modules';
    protected $fillable = ['*'];

    
    public static function getModuleBySlug($slug) {

        if(!empty($slug)){
            $result = self::where('slug',$slug)->get()->toArray();
            return $result;
        }
    }
    
    
}

