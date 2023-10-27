<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    //
    public function index(Request $request) 
    {
        $menus = Menu::all();
        return view('cms.menu.index')->with('menus',$menus);
    }

    public function add(Request $request){
        return view('cms.menu.add');
    }

    public function store(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:menus',
            'status' => 'required',
        ]);
        $title = $request->input('title');
        $link =  $request->input('link');
        $icon = $request->input('icon');
        $objects = [];
        if (count($title) == count($link) && count($link) == count($icon)) {
            $count = count($title);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->title = $title[$i];
                $object->link = $link[$i];
                $object->icon = $icon[$i];
                $objects[] = $object;
            }
        }
        $menu = new Menu;
        $menu->name = $request->input('name');
        $menu->slug = $request->input('slug');
        $menu->status = $request->input('status');
        $menu->items = $objects;
    
        $menu->save();
    
        return redirect()->route('menus.index')->with('success', 'Menu created successfully');
    }

    
}
