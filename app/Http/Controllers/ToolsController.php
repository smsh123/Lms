<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tool;

class ToolsController extends Controller
{
    //
    public function index(Request $request){

        if(!User::hasPermissions(["View Tool"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->name)) {
             $tools = Tool::searchByFields(['name' => $request->name]);
        } elseif (!empty($request->slug)) {
             $tools = Tool::searchByFields(['slug' => $request->slug]);
        } else {
            $tools = Tool::paginateWithDefault(10);
        }
        return view('cms.tools.index')->with('tools',$tools);
    }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Tools"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $data = [
            'page_group' => 'tool'
        ];
        return view('cms.tools.add',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'slug'=> 'required|string|max:255|unique:tools',
        ]);
    
        $tool = new Tool;
        $tool->name = $request->input('name');
        $tool->name_hindi = $request->input('name_hindi');
        $tool->slug = $request->input('slug');
        $tool->description = $request->input('description');
        $tool->synopsis = $request->input('synopsis');
        $tool->thumbnail_image = $request->input('thumbnail_image');
        $tool->banner_image = $request->input('banner_image');
    
        $tool->save();
    
        return redirect()->route('tools.index')->with('success', 'Tool created successfully');
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Tools"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
       
        $tools = Tool::find($id);
        $data = [
            'tools' => !empty($tools) ? $tools : [],
            'page_group' => 'tool'
        ];
        return view('cms.tools.edit',$data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'slug'=> 'required|string|max:255',
        ]);
        $id = $request->input("id",'');
        $tool = Tool::find($id);
        
        $tool->name = $request->input('name');
        $tool->name_hindi = $request->input('name_hindi');
        $tool->description = $request->input('description');
        $tool->synopsis = $request->input('synopsis');
        $tool->thumbnail_image = $request->input('thumbnail_image');
        $tool->banner_image = $request->input('banner_image');
    
        $tool->save();
    
        return redirect()->route('tools.index')->with('success', 'Tool updated successfully');
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Tool"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $tool = Tool::find($id);
        $tool->delete();
        return redirect()->back()->with('msg', 'Tool Deleted Successfully!');
    }
    
}
