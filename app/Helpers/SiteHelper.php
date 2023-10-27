<?php


namespace App\Helpers;

use App\Models\Menu;

class SiteHelper
{
    public static function getMenuBySlug($slug = null)
    {
        $menus = Menu::getMenuBySlug($slug);
        return isset($menus) && !empty($menus) ? $menus : []; 
    }

}
