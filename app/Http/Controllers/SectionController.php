<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\User;
use App\Models\Course;
use App\Models\Blog;

class SectionController extends Controller
{
    //
    public function index(Request $request) 
    {
        if(!User::hasPermissions(["View Section"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->name)) {
            $sections = Section::searchByFields(['name' => $request->name]);
        } elseif (!empty($request->display_title)) {
            $sections = Section::searchByFields(['display_title' => $request->display_title]);
        } elseif (!empty($request->tagline)) {
            $sections = Section::searchByFields(['tagline' => $request->tagline]);
        }else {
            $sections = Section::paginateWithDefault(10);
        }
        
        return view('cms.section.index')->with('sections',$sections);
    }

    public function add(Request $request){
        if(!User::hasPermissions(["Add Section"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $mentors = User::getUserByRole('Teacher');
        $courses = Course::all();
        $blogs = Blog::all();
        $data = [
            'mentors' => !empty($mentors) ? $mentors : [],
            'courses' =>  !empty($courses) ? $courses : [],
            'blogs' => !empty($blogs) ? $blogs : [],
            'page_group' => 'section'
        ];

        return view('cms.section.add',$data);
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Section"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $sections = Section::find($id);
        $mentors = User::getUserByRole('Teacher');
        $courses = Course::all();
        $blogs = Blog::all();
        $data = [
            'mentors' => !empty($mentors) ? $mentors : [],
            'courses' =>  !empty($courses) ? $courses : [],
            'blogs' => !empty($blogs) ? $blogs : [],
            'sections' => !empty($sections) ? $sections : [],
            'page_group' => 'section'
        ];
        return view('cms.section.edit', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:sections',
            'description' => 'required',
        ]);

        $section= new Section;
        $section->name = $request->input('name');
        $section->display_title = $request->input('display_title');
        $section->slug = $request->input('slug');
        $section->tagline = $request->input('tagline');
        $section->listitems = $request->input('listitems');
        $section->mentors = $request->input('mentors');
        $section->blogs = $request->input('blogs');
        $section->courses = $request->input('courses');
        $section->description = $request->input('description');
        $section->synopsis = $request->input('synopsis');
        $section->thumbnail_image = $request->input('thumbnail_image');
        $section->banner_image = $request->input('banner_image');

        $section->save();
    
        return redirect()->route('sections.index')->with('success', 'Section created successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
        ]);

        $id = $request->input("id");
        $section= Section::find($id);
        $section->name = $request->input('name');
        $section->display_title = $request->input('display_title');
        $section->tagline = $request->input('tagline');
        $section->listitems = $request->input('listitems');
        $section->mentors = $request->input('mentors');
        $section->blogs = $request->input('blogs');
        $section->courses = $request->input('courses');
        $section->description = $request->input('description');
        $section->synopsis = $request->input('synopsis');
        $section->thumbnail_image = $request->input('thumbnail_image');
        $section->banner_image = $request->input('banner_image');

        $section->save();

        return redirect()->route('sections.index')->with('success', 'Section Updated successfully');
    }

    public function changeStatus(Request $request, $id) {
        if(!empty($id)){
            $section = Section::find($id);
            $status = !empty($section->is_public) ? $section->is_public : 0 ;
            if($status == 1){
                $section->is_public = 0;
                $section->save();
                return redirect()->back()->with('success', 'Unpublished successfully');
            } elseif($status == 0){
                $section->is_public = 1;
                $section->save();
                return redirect()->back()->with('success', 'Published successfully');
            }
        }else{
            abort(404);
        }
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Section"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $section= Section::find($id);
        $section->delete();
        return redirect()->back()->with('msg', 'Section Deleted Successfully!');
    }

    
}
