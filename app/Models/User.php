<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable;
    protected $collection = 'users'; 

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'avatar_image',
        'password',
        'user_type'
       
    ];

    public static function userHasDirectPermission($permission = ""){
        $user = \Auth::user();
        if (!empty($user->roles) && in_array("Super Admin",$user->roles)) {
            return true;
        }
        if (!empty($user->permissions) && in_array($permission,$user->permissions)) {
                return true;
        }
        return false;
    }

    public static function hasPermissions($permissions = []){
        foreach ($permissions as $key => $permission) {
            if (self::userHasDirectPermission($permission) || Role::roleHasPermission($permission)) {
                return true;
            }   
        }
        return false;
    }
}
