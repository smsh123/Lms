<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    //
    public function index(Request $request){

        $testimonials =Testimonial::all();
        $users = User::all();
        return view('cms.testimonial.index')->with('testimonial',$testimonials,'users',!empty($users) ? $users : []);
      }
    public function add(Request $request){
    return view('cms.testimonial.add');
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
       
    
        $testimonial->save();
    
        return redirect()->route('cms.testimonial.index')->with('success', 'Course created successfully');
    }
    public function listing(Request $request){

        $testimonials =Testimonial::all();
        return view('testimonial.index')->with('testimonial',$testimonials);
    }

    public function testimonialEdit(Request $request, $id) {
        $testimonials =Testimonial::find($id);
        $users = User::all();
        // dd($course);
        return view('cms.testimonial.edit')->with('testimonial',$testimonials,'users',!empty($users) ? $users : []);
    }
    public function update(Request $request)
    {
        $request->validate([
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
    
        $testimonial->save();
    
        return redirect()->route('cms.testimonial.index')->with('success', 'Testimonial updated successfully');
    }
    
}
