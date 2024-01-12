<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    //
    public function index(Request $request){
        if(!User::hasPermissions(["View Testimonial"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->name)) {
            $testimonials =Testimonial::searchByFields(['name' => $request->name]);
        } elseif (!empty($request->type)) {
            $testimonials =Testimonial::searchByFields(['type' => $request->type]);
        } elseif (!empty($request->user)) {
            $testimonials =Testimonial::searchByFields(['user' => $request->user]);
        } else {
            $testimonials =Testimonial::paginateWithDefault(10);
        }
        
        $users = User::all();
        return view('cms.testimonial.index')->with('testimonials',$testimonials,'users',!empty($users) ? $users : []);
      }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Testimonial"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $users = User::all();
        $data = [
            'page_group' => 'testimonial',
            'users'=> !empty($users) ? $users : [],
        ];
        return view('cms.testimonial.add',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'user' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|string',
        ]);
    
        $testimonial = new Testimonial;
        $testimonial->user = $request->input('user');
        $testimonial->type = $request->input('type');
        $testimonial->synopsis = $request->input('synopsis');
        $testimonial->image = $request->input('image');
        $testimonial->video = $request->input('video');
        $testimonial->status = $request->input('status');
        $testimonial->thumbnail_image = $request->input('thumbnail_image');
       
    
        $testimonial->save();
    
        return redirect()->route('testimonial.index')->with('msg', 'Course created successfully');
    }
    public function listing(Request $request){

        $testimonials =Testimonial::all();
        return view('testimonial.index')->with('testimonial',$testimonials);
    }

    public function testimonialEdit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Testimonial"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $testimonials =Testimonial::find($id);
        $users = User::all();
        $data = [
            "testimonial" => $testimonials,
            "users" => !empty($users) ? $users : [],
            'page_group' => 'testimonial',
        ];
        return view('cms.testimonial.edit',$data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'user' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $id = $request->input("id",'');
        $testimonial =Testimonial::find($id);
        $testimonial->user = $request->input('user');
        $testimonial->type = $request->input('type');
        $testimonial->synopsis = $request->input('synopsis');
        $testimonial->image = $request->input('image');
        $testimonial->video = $request->input('video');
        $testimonial->status = $request->input('status');
        $testimonial->thumbnail_image = $request->input('thumbnail_image');
    
        $testimonial->save();
    
        return redirect()->route('testimonial.index')->with('msg', 'Testimonial updated successfully');
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Testimonial"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        return redirect()->back()->with('msg', 'Testimonial Deleted Successfully!');
    }
    
}
