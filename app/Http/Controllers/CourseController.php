<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;

class CourseController extends Controller
{
    //
    public function index(Request $request){

        $courses = Course::all();
        return view('cms.courses.index')->with('courses',$courses);
      }
    public function add(Request $request){
    return view('cms.courses.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hn' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'slug'=> 'required|string|max:255',
        ]);
    
        $course = new Course;
        $course->name = $request->input('name');
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
    
        $course->save();
    
        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }
    public function listing(Request $request){

        $courses = Course::all();
        return view('course.index')->with('courses',$courses);
    }

    public function courseEdit(Request $request, $id) {
        $course = Course::find($id);
        // dd($course);
        return view('cms.courses.edit')->with('course',$course);
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
        $course = Course::find($id);
        $course->name = $request->input('name');
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
    
        $course->save();
    
        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }
    
}
