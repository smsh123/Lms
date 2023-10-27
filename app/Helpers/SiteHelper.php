<?php


namespace App\Helpers;

use App\Models\Menu;

class SiteHelper
{
    public static function GetMenus($pageNo = 1, $refresh = null)
    {
        $menus = Menu::all();
        return isset($menus) && !empty($menus) ? $menus : []; 
    }

}
