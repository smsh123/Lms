<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\Module;
use App\Models\CourseModuleMapping;

class SchedulingController extends Controller
{
    //
    public function index(Request $request){

        $schedules = Schedule::all();
        return view('cms.scheduling.index')->with('schedules',$schedules);
    }
    public function add(Request $request){
        $courses = Course::all();
        return view('cms.scheduling.add')->with('courses',$courses);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hn' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'slug'=> 'required|string|max:255|unique:courses',
        ]);
    
        $schedule = new Schedule;
        $schedule->name = $request->input('name');
        $schedule->name_hindi = $request->input('name_hindi');
        $schedule->slug = $request->input('slug');
        $schedule->batch_start_date = $request->input('batch_start_date');
        $schedule->duration = $request->input('duration');
        $schedule->class_mode = $request->input('class_mode');
        $schedule->description = $request->input('description');
        $schedule->synopsis = $request->input('synopsis');
        $schedule->original_price = $request->input('original_price');
        $schedule->selling_price = $request->input('selling_price');
        $schedule->offer_type = $request->input('offer_type');
        $schedule->offer_unit = $request->input('offer_unit');
        $schedule->offer_value = $request->input('offer_value');
        $schedule->coupon_code = $request->input('coupon_code');
        $schedule->offer_details = $request->input('offer_details');
        $schedule->thumbnail_image = $request->input('thumbnail_image');
        $schedule->banner_image = $request->input('banner_image');
    
        $schedule->save();
    
        return redirect()->route('schedule.index')->with('success', 'Schedule created successfully');
    }

    public function scheduleEdit(Request $request, $id) {
        $schedules = Course::find($id);
        // dd($course);
        return view('cms.scheduling.edit')->with('schedule',$schedules);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hn' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'slug'=> 'required|string|max:255',
        ]);
        $id = $request->input("id",'');
        $schedule = Schedule::find($id);
        $schedule->name = $request->input('name');
        $schedule->name_hindi = $request->input('name_hindi');
        $schedule->slug = $request->input('slug');
        $schedule->batch_start_date = $request->input('batch_start_date');
        $schedule->duration = $request->input('duration');
        $schedule->class_mode = $request->input('class_mode');
        $schedule->description = $request->input('description');
        $schedule->synopsis = $request->input('synopsis');
        $schedule->original_price = $request->input('original_price');
        $schedule->selling_price = $request->input('selling_price');
        $schedule->offer_type = $request->input('offer_type');
        $schedule->offer_unit = $request->input('offer_unit');
        $schedule->offer_value = $request->input('offer_value');
        $schedule->coupon_code = $request->input('coupon_code');
        $schedule->offer_details = $request->input('offer_details');
        $schedule->thumbnail_image = $request->input('thumbnail_image');
        $schedule->banner_image = $request->input('banner_image');
    
        $schedule->save();
    
        return redirect()->route('schedule.index')->with('success', 'Schedule updated successfully');
    }
    public function getModulesByCourse(Request $request,$courseId=''){
        $courseId = $request->input('courseId');
        if(!empty($courseId)){
            $modules = CourseModuleMapping::getModulesByCourseId($courseId);
           // dd($modules);
            return $modules;

        }else{
            dd('Course Id Not Found');
        }
        
    }

    public function getSubModulesByModuleId(Request $request,$moduleId=''){
        $moduleId = $request->input('moduleId');
        if(!empty($moduleId)){
            $moduleDetails = Module::getModuleById($moduleId);
           // dd($modules);
            return $moduleDetails;

        }else{
            dd('Module Id Not Found');
        }
        
    }
    
}
