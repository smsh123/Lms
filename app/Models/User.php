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

    public static function userHasDirectPermission($permission = "")
    {
        $user = \Auth::user();
        if (!empty($user->roles) && in_array("Super Admin", $user->roles)) {
            return true;
        }
        if (!empty($user->permissions) && in_array($permission, $user->permissions)) {
            return true;
        }
        return false;
    }

    public static function hasPermissions($permissions = [])
    {
        foreach ($permissions as $key => $permission) {
            if (self::userHasDirectPermission($permission) || Role::roleHasPermission($permission)) {
                return true;
            }
        }
        return false;
    }
    public static function getUserByRole($role = '')
    {
        if (!empty($role)) {
            $result = self::where('roles', $role)->where('is_public',1)->get()->toArray();
            return $result;
        }
    }
    public static function searchByFields($fields = [], $limit = 10)
    {
        $result = [];
        if (!empty($fields)) {
            $query = self::query();

            foreach ($fields as $field => $value) {
                $query->where($field, 'regex', "/$value/i");
            }
            $result = $query->paginate($limit);
        }
        return $result;
    }
    public static function paginateWithDefault($limit = 10, $columns = ['*'])
    {
        return static::paginate($limit, $columns);
    }
}
