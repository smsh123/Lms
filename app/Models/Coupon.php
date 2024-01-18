<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Coupon extends BaseModel
{
    protected $collection = 'coupons';
    protected $fillable = ['*'];

    
    public static function getCouponByCode($code) {

        if(!empty($code)){
            $result = self::where('code',$code)->where('is_public',1)->get()->first()->toArray();
            return $result;
        }
    }
    
    
}

