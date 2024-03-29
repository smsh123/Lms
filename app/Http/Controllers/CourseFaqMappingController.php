<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Course;
use App\Models\CourseFaqMapping;
use App\Models\User;


class CourseFaqMappingController extends Controller
{
    //
    public function index(Request $request) 
    {
        if(!User::hasPermissions(["View Mapping"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        //$modules = Module::all();
        $mappings = CourseFaqMapping::paginateWithDefault(10);
        return view('cms.course_faq_mapping.index')->with('mappings',$mappings);
    }

    public function add(Request $request){
        if(!User::hasPermissions(["Add Mapping"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $faqs = Faq::all();
        $courses = Course::all();
        $data=[
            "courses" => !empty($courses) ? $courses : [],
            "faqs" =>  !empty($faqs) ? $faqs : [],
            'page_group' => 'mapping'
        ];
        return view('cms.course_faq_mapping.add', $data);
    }

    public function edit(Request $request, $id) {

        if(!User::hasPermissions(["Edit Mapping"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        
        $mappings = CourseFaqMapping::find($id);
        $faqs = Faq::all();
        $courses = Course::all();
        $data=[
            "courses" => !empty($courses) ? $courses : [],
            "faqs" =>  !empty($faqs) ? $faqs : [],
            "mappings" =>  !empty($mappings) ? $mappings : [],
            'page_group' => 'mapping'
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
    
        return redirect()->route('mapping.index')->with('success', 'Mapping Updated successfully');
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
    
        return redirect()->route('mapping.index')->with('success', 'Mapping Updated successfully');
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Mapping"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $mapping = CourseFaqMapping::find($id);
        $mapping->delete();
        return redirect()->back()->with('msg', 'Mapping Deleted Successfully!');
    }

    
}
