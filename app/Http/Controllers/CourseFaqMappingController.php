<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Course;
use App\Models\CourseFaqMapping;


class CourseFaqMappingController extends Controller
{
    //
    public function index(Request $request) 
    {
        //$modules = Module::all();
        $mappings = CourseFaqMapping::all();
        return view('cms.course_faq_mapping.index')->with('mappings',$mappings);
    }

    public function add(Request $request){
        if(!in_array('Add Mapping',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $faqs = Faq::all();
        $courses = Course::all();
        $data=[
            "courses" => !empty($courses) ? $courses : [],
            "faqs" =>  !empty($faqs) ? $faqs : []
        ];
        return view('cms.course_faq_mapping.add', $data);
    }

    public function edit(Request $request, $id) {
        if(!in_array('Edit Mapping',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $mappings = CourseFaqMapping::find($id);
        $faqs = Faq::all();
        $courses = Course::all();
        $data=[
            "courses" => !empty($courses) ? $courses : [],
            "faqs" =>  !empty($faqs) ? $faqs : [],
            "mappings" =>  !empty($mappings) ? $mappings : []
        ];
        // dd($course);
        return view('cms.course_faq_mapping.edit', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'course' => 'required|string|max:255',
        ]);
        $faqId = $request->input('faq_id');
        $faqName= $request->input('faq_name');
        $objects = [];
        if (!empty($faqId) && !empty($faqName)) {
            $count = count($faqId);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->faqId = $faqId[$i];
                $object->faqName = $faqName[$i];
                $objects[] = $object;
            }
        }
        $mapping = new CourseFaqMapping;
        $mapping->course = $request->input('course');
        $mapping->faqs = $objects;
    
        $mapping->save();
    
        return view("cms.course_faq_mapping.index")->with('msg', 'Mapping created successfully');
    }

    public function update(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'course' => 'required|string|max:255',
        ]);
        $faqId = $request->input('faq_id');
        $faqName= $request->input('faq_name');
        //dd($request);
        $objects = [];
        if (!empty($faqId) && !empty($faqName)) {
            $count = count($faqId);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->faqId = $faqId[$i];
                $object->faqQuestion = $faqName[$i];
                $objects[] = $object;
            }
        }
        $id = $request->input("id");
        $mapping = CourseFaqMapping::find($id);
        $mapping->course = $request->input('course');
        $mapping->faqs = $objects;
    
        $mapping->save();
    
        return view("cms.course_faq_mapping.index")->with('msg', 'Mapping created successfully');
    }

    public function destroy($id)
    {
        if(!in_array('Delete Mapping',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $mapping = CourseFaqMapping::find($id);
        $mapping->delete();
        return redirect()->back()->with('msg', 'Mapping Deleted Successfully!');
    }

    
}
