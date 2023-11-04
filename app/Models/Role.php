<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Role extends BaseModel
{
    protected $collection = 'roles';
    protected $fillable = ['*'];

    public static function roleHasPermission($permission = ""){
        $user = \Auth::user();
        if (!empty($user->roles) && in_array("Super Admin",$user->roles)) {
            return true;
        }
        if (!empty($user->roles)) {
            foreach ($user->roles as $role) {
                $tempPermisssion  = self::where('name',$role)->first(['permissions']);
                $tempPermisssion  = !empty($tempPermisssion->permissions) ? $tempPermisssion->permissions : [];
                if (in_array($permission,$tempPermisssion)) {
                   return true;
                }
            }
        }
        return false;
    }
}

