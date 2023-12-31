<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\User;

class SectionController extends Controller
{
    //
    public function index(Request $request) 
    {
        $sections = Section::paginateWithDefault(10);
        return view('cms.section.index')->with('sections',$sections);
    }

    public function add(Request $request){
        if(!User::hasPermissions(["Add Section"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        return view('cms.section.add');
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Section"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $sections = Section::find($id);
        $data=[
            'sections' => !empty($sections) ? $sections : []
        ];
        // dd($course);
        return view('cms.section.edit', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:menus',
            'status' => 'required',
        ]);
        $title = $request->input('title');
        $link =  $request->input('link');
        $icon = $request->input('icon');
        $objects = [];
        if (count($title) == count($link) && count($link) == count($icon)) {
            $count = count($title);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->title = $title[$i];
                $object->link = $link[$i];
                $object->icon = $icon[$i];
                $objects[] = $object;
            }
        }
        $section= new Section;
        $section->name = $request->input('name');
        $section->slug = $request->input('slug');
        $section->status = $request->input('status');
        $section->items = $objects;
    
        $section->save();
    
        return redirect()->route('sections.index')->with('success', 'Section created successfully');
    }

    public function update(Request $request)
    {
        // dd($request->all(),$jsonObject = json_encode($objects));
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);
        $title = $request->input('title');
        $link =  $request->input('link');
        $icon = $request->input('icon');
        $objects = [];
        if (count($title) == count($link) && count($link) == count($icon)) {
            $count = count($title);
            for ($i = 0; $i < $count; $i++) {
                $object = new \stdClass(); 
                $object->title = $title[$i];
                $object->link = $link[$i];
                $object->icon = $icon[$i];
                $objects[] = $object;
            }
        }
        $id = $request->input("id");
        $section= Section::find($id);
        $section->name = $request->input('name');
        $section->status = $request->input('status');
        $section->items = $objects;
    
        $section->save();
    
        return redirect()->route('sections.index')->with('success', 'Section Updated successfully');
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
