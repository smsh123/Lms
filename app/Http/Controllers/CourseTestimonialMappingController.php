<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Course;
use App\Models\CourseTestimonialMapping;


class CourseTestimonialMappingController extends Controller
{
    //
    public function index(Request $request) 
    {
        //$modules = Module::all();
        $mappings = CourseTestimonialMapping::all();
        return view('cms.course_testimonial_mapping.index')->with('mappings',$mappings);
    }

    public function add(Request $request){
        $testimonials = Testimonial::all();
        $courses = Course::all();
        $data=[
            "courses" => !empty($courses) ? $courses : [],
            "testimonials" =>  !empty($testimonials) ? $testimonials : []
        ];
        return view('cms.course_testimonial_mapping.add', $data);
    }

    public function edit(Request $request, $id) {
        $mappings = CourseTestimonialMapping::find($id);
        $testimonials = Testimonial::all();
        $courses = Course::all();
        $data=[
            "courses" => !empty($courses) ? $courses : [],
            "testimonials" =>  !empty($testimonials) ? $testimonials : [],
            "mappings" =>  !empty($mappings) ? $mappings : []
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
    
        return view("cms.course_testimonial_mapping.index")->with('msg', 'Mapping created successfully');
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
                $object->faqQuestion = $testimonialName[$i];
                $objects[] = $object;
            }
        }
        $id = $request->input("id");
        $mapping = CourseTestimonialMapping::find($id);
        $mapping->course = $request->input('course');
        $mapping->testimonials = $objects;
    
        $mapping->save();
    
        return view("cms.course_testimonial_mapping.index")->with('msg', 'Mapping created successfully');
    } 
}
