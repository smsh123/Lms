<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Reply extends BaseModel
{
    protected $collection = 'replies';
    protected $fillable = ['*'];

    
    public static function getRepliesByTicketId($ticketId) {

        if(!empty($ticketId)){
            $result = self::where('ticket_id',$ticketId)->get()->toArray();
            return $result;
        }
    }
    
    
}

