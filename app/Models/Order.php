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
    public static function getOrderByUserId($user_id) {

        if(!empty($user_id)){
            $result = self::where('user_id',$user_id)->get()->toArray();
            return $result;

        }
    }

}

