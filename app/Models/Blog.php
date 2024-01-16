<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Blog extends BaseModel
{
    protected $collection = 'blogs';
    protected $fillable = ['*'];

    public static function getBlogBySlug($slug) {

        if(!empty($slug)){
            $result = self::where('slug',$slug)->get()->toArray();
            return $result;
        }
    }
    public static function getActiveBlogs() {

        $result = self::where('is_public', 1)->get()->toArray();
        return $result;

    }
}

