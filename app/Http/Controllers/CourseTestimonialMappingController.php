<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Course;
use App\Models\CourseTestimonialMapping;
use App\Models\User;


class CourseTestimonialMappingController extends Controller
{
    //
    public function index(Request $request) 
    {
        if(!User::hasPermissions(["View Mapping"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        //$modules = Module::all();
        $mappings = CourseTestimonialMapping::paginateWithDefault(10);
        return view('cms.course_testimonial_mapping.index')->with('mappings',$mappings);
    }

    public function add(Request $request){
        if(!User::hasPermissions(["Add Mapping"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $testimonials = Testimonial::all();
        $courses = Course::all();
        $data=[
            "courses" => !empty($courses) ? $courses : [],
            "testimonials" =>  !empty($testimonials) ? $testimonials : [],
            'page_group' => 'mapping'
        ];
        return view('cms.course_testimonial_mapping.add', $data);
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Mapping"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $mappings = CourseTestimonialMapping::find($id);
        $testimonials = Testimonial::all();
        $courses = Course::all();
        $data=[
            "courses" => !empty($courses) ? $courses : [],
            "testimonials" =>  !empty($testimonials) ? $testimonials : [],
            "mappings" =>  !empty($mappings) ? $mappings : [],
            'page_group' => 'mapping'
        ];
        // dd($course);
        return view('cms.course_testimonial_mapping.edit', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'course' => 'required|string|max:255',
        ]);
        $testimonialId = $request->input('testimonial_id');
        $testimonialName= $request->input('testimonial_name');
        $objects = [];
        if (!empty($testimonialId) && !empty($testimonialName)) {
            $count = count($testimonialId);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->testimonialId = $testimonialId[$i];
                $object->testimonialName = $testimonialName[$i];
                $objects[] = $object;
            }
        }
        $mapping = new CourseTestimonialMapping;
        $mapping->course = $request->input('course');
        $mapping->testimonials = $objects;
    
        $mapping->save();
    
        // return view("cms.course_testimonial_mapping.index")->with('msg', 'Mapping created successfully');
        return redirect()->route('mapping.index')->with('success', 'Mapping created successfully');
    }

    public function update(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'course' => 'required|string|max:255',
        ]);
        $testimonialId = $request->input('testimonial_id');
        $testimonialName= $request->input('testimonial_name');
        //dd($request);
        $objects = [];
        if (!empty($testimonialId) && !empty($testimonialName)) {
            $count = count($testimonialId);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->testimonialId = $testimonialId[$i];
                $object->testimonialName = $testimonialName[$i];
                $objects[] = $object;
            }
        }
        $id = $request->input("id");
        $mapping = CourseTestimonialMapping::find($id);
        $mapping->course = $request->input('course');
        $mapping->testimonials = $objects;
    
        $mapping->save();
    
        return redirect()->route('mapping.index')->with('success', 'Mapping Updated successfully');
    } 

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Mapping"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $mapping = CourseTestimonialMapping::find($id);
        $mapping->delete();
        return redirect()->back()->with('msg', 'Mapping Deleted Successfully!');
    }
}
