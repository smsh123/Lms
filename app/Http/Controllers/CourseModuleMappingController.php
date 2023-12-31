<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Course;
use App\Models\CourseModuleMapping;
use App\Models\User;

class CourseModuleMappingController extends Controller
{
    //
    public function index(Request $request) 
    {
        //$modules = Module::all();
        $mappings = CourseModuleMapping::paginateWithDefault(10);
        return view('cms.course_module_mapping.index')->with('mappings',$mappings);
    }

    public function add(Request $request){
        if(!User::hasPermissions(["Add Mapping"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $modules = Module::all();
        $courses = Course::all();
        $data=[
            "courses" => !empty($courses) ? $courses : [],
            "modules" =>  !empty($modules) ? $modules : []
        ];
        return view('cms.course_module_mapping.add', $data);
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Mapping"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
     
        $mappings = CourseModuleMapping::find($id);
        $modules = Module::all();
        $courses = Course::all();
        $data=[
            "courses" => !empty($courses) ? $courses : [],
            "modules" =>  !empty($modules) ? $modules : [],
            "mappings" =>  !empty($mappings) ? $mappings : []
        ];
        // dd($course);
        return view('cms.course_module_mapping.edit', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'course' => 'required|string|max:255',
        ]);
        $moduleId = $request->input('module_id');
        $moduleName= $request->input('module_name');
        $objects = [];
        if (!empty($moduleId) && !empty($moduleName)) {
            $count = count($moduleId);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->moduleId = $moduleId[$i];
                $object->moduleName = $moduleName[$i];
                $objects[] = $object;
            }
        }
        $mapping = new CourseModuleMapping;
        $mapping->course = $request->input('course');
        $mapping->modules = $objects;
    
        $mapping->save();
    
        return view("cms.course_module_mapping.index")->with('msg', 'Mapping created successfully');
    }

    public function update(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'course' => 'required|string|max:255',
        ]);
        $moduleId = $request->input('module_id');
        $moduleName= $request->input('module_name');
        //dd($request);
        $objects = [];
        if (!empty($moduleId) && !empty($moduleName)) {
            $count = count($moduleId);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->moduleId = $moduleId[$i];
                $object->moduleName = $moduleName[$i];
                $objects[] = $object;
            }
        }
        $id = $request->input("id");
        $mapping = CourseModuleMapping::find($id);
        $mapping->course = $request->input('course');
        $mapping->modules = $objects;
    
        $mapping->save();
    
        return view("cms.course_module_mapping.index")->with('msg', 'Mapping created successfully');
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Mapping"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $mapping = CourseModuleMapping::find($id);
        $mapping->delete();
        return redirect()->back()->with('msg', 'Mapping Deleted Successfully!');
    }

    
}
