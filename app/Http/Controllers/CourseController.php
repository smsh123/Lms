<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;

class CourseController extends Controller
{
    //
    public function index(Request $request){

        $courses = Course::paginateWithDefault(10);
        return view('cms.courses.index')->with('courses',$courses);
    }
    public function add(Request $request){
        if(!in_array('Add Course',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $mentors = User::getUserByRole('Teacher');
        $data = [
            'mentors' => !empty($mentors) ? $mentors : [], 
        ];
        
        return view('cms.courses.add',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'slug'=> 'required|string|max:255|unique:courses',
        ]);
    
        $course = new Course;
        $course->name = $request->input('name');
        $course->meta_title = $request->input('meta_title');
        $course->meta_keywords = $request->input('meta_keywords');
        $course->meta_description = $request->input('meta_description');
        $course->name_hindi = $request->input('name_hindi');
        $course->slug = $request->input('slug');
        $course->batch_start_date = $request->input('batch_start_date');
        $course->duration = $request->input('duration');
        $course->class_mode = $request->input('class_mode');
        $course->description = $request->input('description');
        $course->synopsis = $request->input('synopsis');
        $course->original_price = $request->input('original_price');
        $course->selling_price = $request->input('selling_price');
        $course->offer_type = $request->input('offer_type');
        $course->offer_unit = $request->input('offer_unit');
        $course->offer_value = $request->input('offer_value');
        $course->coupon_code = $request->input('coupon_code');
        $course->offer_details = $request->input('offer_details');
        $course->thumbnail_image = $request->input('thumbnail_image');
        $course->banner_image = $request->input('banner_image');
        $course->tags = $request->input('tags');
        $course->mentors = $request->input('mentors');
        $course->course_type = $request->input('course_type');
        $course->highlights = $request->input('highlights');
    
        $course->save();
    
        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }
    public function listing(Request $request){
        $courses = Course::all();
        $data = [
            'courses' => !empty($courses) ? $courses : [],
            'meta_title'=>'Explore our highly optimized and personlised courses',
            'meta_keywords'=>'skills courses, smart classes, online classes, courses',
            'meta_description'=>'Aryabhatt classes desing personlised courses that suits to every individuals. Lets explore our highly optimized and personlised courses to boost your career',
            'page_type' => 'course-page' 
        ];
        return view('course.index',$data);
    }
    public function courseDetails(Request $request, $slug){
        $courseDescription = [];
        $courseDescription = Course::getCourseBySlug($slug);
        $data = [
            'CourseDescription' => !empty($courseDescription) ? $courseDescription[0] : [],
            'page_type' => 'course-details-page' 
        ];
        return view('course.details',$data);
    }

    public function courseEdit(Request $request, $id) {
        if(!in_array('Edit Course',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $course = Course::find($id);
        $mentors = User::getUserByRole('Teacher');
        $data = [
            'course' => !empty($course) ? $course : [],
            'mentors' => !empty($mentors) ? $mentors : []
        ];
        // dd($course);
        return view('cms.courses.edit',$data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'slug'=> 'required|string|max:255',
        ]);
        $id = $request->input("id",'');
        $course = Course::find($id);
        $course->name = $request->input('name');
        $course->meta_title = $request->input('meta_title');
        $course->meta_keywords = $request->input('meta_keywords');
        $course->meta_description = $request->input('meta_description');
        $course->name_hindi = $request->input('name_hindi');
        $course->batch_start_date = $request->input('batch_start_date');
        $course->duration = $request->input('duration');
        $course->class_mode = $request->input('class_mode');
        $course->description = $request->input('description');
        $course->synopsis = $request->input('synopsis');
        $course->original_price = $request->input('original_price');
        $course->selling_price = $request->input('selling_price');
        $course->offer_type = $request->input('offer_type');
        $course->offer_unit = $request->input('offer_unit');
        $course->offer_value = $request->input('offer_value');
        $course->coupon_code = $request->input('coupon_code');
        $course->offer_details = $request->input('offer_details');
        $course->thumbnail_image = $request->input('thumbnail_image');
        $course->banner_image = $request->input('banner_image');
        $course->tags = $request->input('tags');
        $course->mentors = $request->input('mentors');
        $course->course_type = $request->input('course_type');
        $course->highlights = $request->input('highlights');
        
    
        $course->save();
    
        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy($id)
    {
        if(!in_array('Delete Course',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $course = Course::find($id);
        $course->delete();
        return redirect()->back()->with('msg', 'Course Deleted Successfully!');
    }
    
}
