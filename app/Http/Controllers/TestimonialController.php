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
        return view('cms.testimonial.index')->with('testimonial',$testimonials);
      }
    public function add(Request $request){
    return view('cms.testimonial.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hn' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'slug'=> 'required|string|max:255|unique:courses',
        ]);
    
        $testimonial = new Testimonial;
        $testimonial->name = $request->input('name');
        $testimonial->name_hindi = $request->input('name_hindi');
        $testimonial->slug = $request->input('slug');
        $testimonial->batch_start_date = $request->input('batch_start_date');
        $testimonial->duration = $request->input('duration');
        $testimonial->class_mode = $request->input('class_mode');
        $testimonial->description = $request->input('description');
        $testimonial->synopsis = $request->input('synopsis');
        $testimonial->original_price = $request->input('original_price');
        $testimonial->selling_price = $request->input('selling_price');
        $testimonial->offer_type = $request->input('offer_type');
        $testimonial->offer_unit = $request->input('offer_unit');
        $testimonial->offer_value = $request->input('offer_value');
        $testimonial->coupon_code = $request->input('coupon_code');
        $testimonial->offer_details = $request->input('offer_details');
    
        $testimonial->save();
    
        return redirect()->route('cms.testimonial.index')->with('success', 'Course created successfully');
    }
    public function listing(Request $request){

        $testimonials =Testimonial::all();
        return view('testimonial.index')->with('testimonial',$testimonials);
    }

    public function courseEdit(Request $request, $id) {
        $testimonials =Testimonial::find($id);
        // dd($course);
        return view('cms.testimonial.edit')->with('testimonial',$testimonials);
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
        $testimonial =Testimonial::find($id);
        $testimonial->name = $request->input('name');
        $testimonial->name_hindi = $request->input('name_hindi');
        $testimonial->slug = $request->input('slug');
        $testimonial->batch_start_date = $request->input('batch_start_date');
        $testimonial->duration = $request->input('duration');
        $testimonial->class_mode = $request->input('class_mode');
        $testimonial->description = $request->input('description');
        $testimonial->synopsis = $request->input('synopsis');
        $testimonial->original_price = $request->input('original_price');
        $testimonial->selling_price = $request->input('selling_price');
        $testimonial->offer_type = $request->input('offer_type');
        $testimonial->offer_unit = $request->input('offer_unit');
        $testimonial->offer_value = $request->input('offer_value');
        $testimonial->coupon_code = $request->input('coupon_code');
        $testimonial->offer_details = $request->input('offer_details');
    
        $testimonial->save();
    
        return redirect()->route('cms.testimonial.index')->with('success', 'Testimonial updated successfully');
    }
    
}
