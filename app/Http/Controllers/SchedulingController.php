<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\Module;
use App\Models\CourseModuleMapping;
use App\Models\User;

class SchedulingController extends Controller
{
    //
    public function index(Request $request){

        if(!User::hasPermissions(["View Schedule"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->course)) {
            $schedules = Schedule::searchByFields(['course' => $request->course]);
        } elseif (!empty($request->module)) {
            $schedules = Schedule::searchByFields(['module' => $request->module]);
        } elseif (!empty($request->sub_module)) {
            $schedules = Schedule::searchByFields(['sub_module' => $request->sub_module]);
        }elseif (!empty($request->teacher)) {
            $schedules = Schedule::searchByFields(['teacher' => $request->teacher]);
        }else {
            $schedules = Schedule::paginateWithDefault(10);
        }

        
        return view('cms.scheduling.index')->with('schedules',$schedules);
    }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Schedule"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $courses = Course::all();
        $teachers = User::getUserByRole('Teacher');
        $data = [
            "courses"=>!empty($courses) ? $courses : [],
            "teachers"=>!empty($teachers) ? $teachers : [],
            'page_group' => 'schedule'
        ];
        return view('cms.scheduling.add',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'course' => 'required|string|max:255',
            'course_id' => 'required|string|max:255',
            'module' => 'required|string',
            'module_id' => 'required|string|max:255',
            'sub_module' => 'required|string|max:255',
            'class_start_time'=> 'required|string|max:255',
            'class_end_time'=> 'required|string|max:255',
            'teacher_id'=> 'required|string|max:255',
        ]);
    
        $schedule = new Schedule;
        $schedule->course = $request->input('course');
        $schedule->course_id = $request->input('course_id');
        $schedule->module = $request->input('module');
        $schedule->module_id = $request->input('module_id');
        $schedule->sub_module = $request->input('sub_module');
        $schedule->class_start_time = $request->input('class_start_time');
        $schedule->class_end_time = $request->input('class_end_time');
        $schedule->teacher = $request->input('teacher');
        $schedule->teacher_id = $request->input('teacher_id');
        $schedule->video_id = $request->input('video_id');
        $schedule->video_type = $request->input('video_type');
        $schedule->study_material = $request->input('study_material');
        $schedule->class_type = $request->input('class_type');
        $schedule->save();
    
        return redirect()->route('schedule.index')->with('success', 'Schedule created successfully');
    }

    public function scheduleEdit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Schedule"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $schedules = Schedule::find($id);
        $courses = Course::all();
        $teachers = User::getUserByRole('Teacher');
        $data=[
            "schedule" => !empty($schedules) ? $schedules : [],
            "courses" => !empty($courses) ? $courses : [],
            "teachers" => !empty($teachers) ? $teachers : [],
            'page_group' => 'schedule'
        ];
        // dd($course);
        return view('cms.scheduling.edit',$data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'course' => 'required|string|max:255',
            'course_id' => 'required|string|max:255',
            'module' => 'required|string',
            'module_id' => 'required|string|max:255',
            'sub_module' => 'required|string|max:255',
            'class_start_time'=> 'required|string|max:255',
            'class_end_time'=> 'required|string|max:255',
            'teacher_id'=> 'required|string|max:255',
        ]);
    
        $id = $request->input("id",'');
        $schedule = Schedule::find($id);
        $schedule->course = $request->input('course');
        $schedule->course_id = $request->input('course_id');
        $schedule->module = $request->input('module');
        $schedule->module_id = $request->input('module_id');
        $schedule->sub_module = $request->input('sub_module');
        $schedule->class_start_time = $request->input('class_start_time');
        $schedule->class_end_time = $request->input('class_end_time');
        $schedule->teacher = $request->input('teacher');
        $schedule->teacher_id = $request->input('teacher_id');
        $schedule->video_id = $request->input('video_id');
        $schedule->video_type = $request->input('video_type');
        $schedule->study_material = $request->input('study_material');
        $schedule->class_type = $request->input('class_type');
        $schedule->save();
    
        return redirect()->route('schedule.index')->with('success', 'Schedule created successfully');
    }

    public function getModulesByCourse(Request $request,$courseId=''){
        $courseId = $request->input('courseId');
        if(!empty($courseId)){
            $modules = CourseModuleMapping::getModulesByCourseId($courseId);
           // dd($modules);
            return $modules;

        }else{
            return 'Course Id Not Found';
        }
        
    }

    public function getSubModulesByModuleId(Request $request,$moduleId=''){
        $moduleId = $request->input('moduleId');
        if(!empty($moduleId)){
            $moduleDetails = Module::getModuleById($moduleId);
           // dd($modules);
            return $moduleDetails;

        }else{
            return 'Module Id Not Found';
        }
        
    }
    
}
