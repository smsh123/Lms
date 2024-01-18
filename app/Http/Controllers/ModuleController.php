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
        if(!User::hasPermissions(["View Module"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->name)) {
            $modules = Module::searchByFields(['name' => $request->name]);
        } elseif (!empty($request->slug)) {
            $modules = Module::searchByFields(['slug' => $request->slug]);
        }else {
            $modules = Module::paginateWithDefault(10);
        }
        
        return view('cms.module.index')->with('modules',$modules);
    }

    public function add(Request $request){
        if(!User::hasPermissions(["Add Module"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $data = [
            'page_group' => 'module'
        ];
        return view('cms.module.add',$data);
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Module"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $module = Module::find($id);
        $data=[
            'module' => !empty($module) ? $module : [],
            'page_group' => 'module'
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
        $module->duration = !empty($request->input('duration')) ? $request->input('duration') : 0 ;
        $module->teacher = $request->input('teacher');
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
        $module->duration = !empty($request->input('duration')) ? $request->input('duration') : 0 ;
        $module->teacher = $request->input('teacher');
        $module->items = $objects;
    
        $module->save();
    
        return redirect()->route('modules.index')->with('success', 'Module Updated successfully');
    }

    public function changeStatus(Request $request, $id) {
        if(!empty($id)){
            $module = Module::find($id);
            $status = !empty($module->is_public) ? $module->is_public : 0 ;
            if($status == 1){
                $module->is_public = 0;
                $module->save();
                return redirect()->back()->with('success', 'Unpublished successfully');
            } elseif($status == 0){
                $module->is_public = 1;
                $module->save();
                return redirect()->back()->with('success', 'Published successfully');
            }
        }else{
            abort(404);
        }
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
