<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Page extends BaseModel
{
    protected $collection = 'pages';
    protected $fillable = ['*'];

    public static function getPageBySlug($slug) {

        if(!empty($slug)){
            $result = self::where('slug',$slug)->get()->toArray();
            return $result;
        }
    }   

    public static function getActivePages() {

        $result = self::where('is_public', 1)->get()->toArray();
        return $result;

    }
}

