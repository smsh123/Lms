<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Order extends BaseModel
{
    protected $collection = 'orders';
    protected $fillable = ['*'];


    public static function getOrderByUID($uid) {

        if(!empty($uid)){
            $result = self::where('uid',$uid)->get()->toArray();
            return $result;

        }
    }

}

