<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\User;

class MenuController extends Controller
{
    //
    public function index(Request $request) 
    {
        if(!User::hasPermissions(["View Menu"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->name)) {
            $menus = Menu::searchByFields(['name' => $request->name]);
        } elseif (!empty($request->slug)) {
            $menus = Menu::searchByFields(['slug' => $request->slug]);
        }else {
            $menus = Menu::paginateWithDefault(10);
        }
        
        return view('cms.menu.index')->with('menus',$menus);
    }

    public function add(Request $request){
        if(!User::hasPermissions(["Add Menu"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $data = [
            'page_group' => 'menu'
        ];
        return view('cms.menu.add',$data);
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Menu"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $menus = Menu::find($id);
        $data=[
            'menus' => !empty($menus) ? $menus : [],
            'page_group' => 'menu'
        ];
        // dd($course);
        return view('cms.menu.edit', $data);
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

    public function update(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'name' => 'required|string|max:255',
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
        $id = $request->input("id");
        $menu = Menu::find($id);
        $menu->name = $request->input('name');
        $menu->status = $request->input('status');
        $menu->items = $objects;
    
        $menu->save();
    
        return redirect()->route('menus.index')->with('success', 'Menu Updated successfully');
    }

    public function changeStatus(Request $request, $id) {
        if(!empty($id)){
            $menu = Menu::find($id);
            $status = !empty($menu->is_public) ? $menu->is_public : 0 ;
            if($status == 1){
                $menu->is_public = 0;
                $menu->save();
                return redirect()->back()->with('success', 'Unpublished successfully');
            } elseif($status == 0){
                $menu->is_public = 1;
                $menu->save();
                return redirect()->back()->with('success', 'Published successfully');
            }
        }else{
            abort(404);
        }
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Menu"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $menu = Menu::find($id);
        $menu->delete();
        return redirect()->back()->with('msg', 'Menu Deleted Successfully!');
    }

    
}
