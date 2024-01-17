<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Ticket extends BaseModel
{
    protected $collection = 'tickets';
    protected $fillable = ['*'];

    
    public static function getTicketsByUserId($userId) {

        if(!empty($userId)){
            $result = self::where('user_id',$userId)->get()->toArray();
            return $result;
        }
    }
    
    
}

