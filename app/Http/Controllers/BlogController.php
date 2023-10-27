<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index(Request $request){
        $Blogs = Blog::all();
        return view('cms.blog.index')->with('blogs',$Blogs);
    }
    public function add(Request $request){
        return view('cms.blog.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hn' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'slug'=> 'required|string|max:255|unique:blogs',
        ]);
    
        $blog = new Blog;
        $blog->name = $request->input('name');
        $blog->name_hindi = $request->input('name_hindi');
        $blog->slug = $request->input('slug');
        $blog->batch_start_date = $request->input('batch_start_date');
        $blog->duration = $request->input('duration');
        $blog->class_mode = $request->input('class_mode');
        $blog->description = $request->input('description');
        $blog->synopsis = $request->input('synopsis');
        $blog->original_price = $request->input('original_price');
        $blog->selling_price = $request->input('selling_price');
        $blog->offer_type = $request->input('offer_type');
        $blog->offer_unit = $request->input('offer_unit');
        $blog->offer_value = $request->input('offer_value');
        $blog->coupon_code = $request->input('coupon_code');
        $blog->offer_details = $request->input('offer_details');
    
        $blog->save();
    
        return redirect()->route('cms.blog.index')->with('success', 'Blog created successfully');
    }
    public function listing(Request $request){

        $Blogs = Blog::all();
        return view('blog.index')->with('blogs',$Blogs);
    }

    public function courseEdit(Request $request, $id) {
        $course = Blog::find($id);
        // dd($course);
        return view('cms.blog.edit')->with('blogs',$course);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hn' => 'required|string|max:255',
            'description' => 'required|string',
            'slug'=> 'required|string|max:255',
        ]);
        $id = $request->input("id",'');
        $blog = Blog::find($id);
        $blog->name = $request->input('name');
        $blog->name_hindi = $request->input('name_hindi');
        $blog->slug = $request->input('slug');
        $blog->batch_start_date = $request->input('batch_start_date');
        $blog->duration = $request->input('duration');
        $blog->class_mode = $request->input('class_mode');
        $blog->description = $request->input('description');
        $blog->synopsis = $request->input('synopsis');
    
        $blog->save();
    
        return redirect()->route('cms.blog.index')->with('success', 'Blog updated successfully');
    }
    
}
