<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Subscription extends BaseModel
{
    protected $collection = 'subscriptions';
    protected $fillable = ['*'];


    public static function getSubscriptionsByUserId($UserId) {

        if(!empty($UserId)){
            $result = self::where('user_id',$UserId)->get()->toArray();
            return $result;

        }
    }

    public static function getSubscriptionByUID($uid) {
        if(!empty($uid)){
            $result = self::where('uid',$uid)->get()->toArray();
            return $result;

        }
    }

}

