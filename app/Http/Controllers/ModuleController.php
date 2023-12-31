<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\User;

class ModuleController extends Controller
{
    //
    public function index(Request $request) 
    {
        $modules = Module::paginateWithDefault(10);
        return view('cms.module.index')->with('modules',$modules);
    }

    public function add(Request $request){
        if(!User::hasPermissions(["Add Module"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        return view('cms.module.add');
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Module"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $module = Module::find($id);
        $data=[
            'module' => !empty($module) ? $module : []
        ];
        // dd($course);
        return view('cms.module.edit', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:modules',
            'status' => 'required',
        ]);
        $title = $request->input('title');
        $duration =  $request->input('duration');
        $objects = [];
        if (count($title) == count($duration)) {
            $count = count($title);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->title = $title[$i];
                $object->duration = $duration[$i];
                $objects[] = $object;
            }
        }
        $module = new Module;
        $module->name = $request->input('name');
        $module->slug = $request->input('slug');
        $module->status = $request->input('status');
        $module->items = $objects;
    
        $module->save();
    
        return redirect()->route('modules.index')->with('success', 'Module created successfully');
    }

    public function update(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'status' => 'required',
        ]);
        $title = $request->input('title');
        $duration =  $request->input('duration');
        $objects = [];
        if (count($title) == count($duration)) {
            $count = count($title);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->title = $title[$i];
                $object->duration = $duration[$i];
                $objects[] = $object;
            }
        }
        $id = $request->input("id");
        $module = Module::find($id);
        $module->name = $request->input('name');
        $module->status = $request->input('status');
        $module->items = $objects;
    
        $module->save();
    
        return redirect()->route('modules.index')->with('success', 'Module Updated successfully');
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Module"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $module = Module::find($id);
        $module->delete();
        return redirect()->back()->with('msg', 'Module Deleted Successfully!');
    }

    
}
