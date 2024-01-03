<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index(Request $request){

        $categories = Category::paginateWithDefault(10);
        return view('cms.categories.index')->with('categories',$categories);
    }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Category"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        
        return view('cms.categories.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'slug'=> 'required|string|max:255|unique:courses',
        ]);
    
        $category = new Category;
        $category->category = $request->input('category');
        $category->name = $request->input('name');
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_description = $request->input('meta_description');
        $category->name_hindi = $request->input('name_hindi');
        $category->slug = $request->input('slug');
        $category->batch_start_date = $request->input('start_date');
        $category->duration = $request->input('duration');
        $category->class_mode = $request->input('class_mode');
        $category->description = $request->input('description');
        $category->synopsis = $request->input('synopsis');
        $category->original_price = $request->input('original_price');
        $category->selling_price = $request->input('selling_price');
        $category->offer_type = $request->input('offer_type');
        $category->offer_unit = $request->input('offer_unit');
        $category->offer_value = $request->input('offer_value');
        $category->coupon_code = $request->input('coupon_code');
        $category->offer_details = $request->input('offer_details');
        $category->thumbnail_image = $request->input('thumbnail_image');
        $category->banner_image = $request->input('banner_image');
        $category->tags = !empty($request->input('tags')) ? explode(',',$request->input('tags')) : '';
        $category->mentors = $request->input('mentors');
        $category->course_type = $request->input('course_type');
        $category->highlights = $request->input('highlights');
        $category->tools = $request->input('tools');
        $category->skills = $request->input('skills');
    
        $category->save();
    
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }
    public function listing(Request $request){
        $categories = Category::all();
        $data = [
            'categories' => !empty($categories) ? $categories : [],
            'meta_title'=>'Explore our highly optimized and personlised courses',
            'meta_keywords'=>'skills courses, smart classes, online classes, courses',
            'meta_description'=>'Aryabhatt classes desing personlised courses that suits to every individuals. Lets explore our highly optimized and personlised courses to boost your career',
            'page_type' => 'category-page' 
        ];
        return view('categories.index',$data);
    }
    public function categoryDetails(Request $request, $slug){
        $categoryDescription = [];
        $categoryDescription = Category::getCategoryBySlug($slug);
        if(!empty($categoryDescription)){
            $categoryDescription = $categoryDescription[0];
        }
        $data = [
            'categoryDescription' => !empty($categoryDescription) ? $categoryDescription : [],
            'page_type' => 'category-details-page' 
        ];
        return view('categories.details',$data);
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Category"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
       
        $categories = Category::find($id);
        $data = [
            'categories' => !empty($categories) ? $categories : [],
        ];
        // dd($course);
        return view('cms.categories.edit',$data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'slug'=> 'required|string|max:255',
        ]);
        $id = $request->input("id",'');
        $category = Category::find($id);
        
        $category->category = $request->input('category');
        $category->name = $request->input('name');
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_description = $request->input('meta_description');
        $category->name_hindi = $request->input('name_hindi');
        $category->batch_start_date = $request->input('start_date');
        $category->duration = $request->input('duration');
        $category->class_mode = $request->input('class_mode');
        $category->description = $request->input('description');
        $category->synopsis = $request->input('synopsis');
        $category->original_price = $request->input('original_price');
        $category->selling_price = $request->input('selling_price');
        $category->offer_type = $request->input('offer_type');
        $category->offer_unit = $request->input('offer_unit');
        $category->offer_value = $request->input('offer_value');
        $category->coupon_code = $request->input('coupon_code');
        $category->offer_details = $request->input('offer_details');
        $category->thumbnail_image = $request->input('thumbnail_image');
        $category->banner_image = $request->input('banner_image');
        $category->tags = !empty($request->input('tags')) ? explode(',',$request->input('tags')) : [];
        $category->mentors = $request->input('mentors');
        $category->course_type = $request->input('course_type');
        $category->highlights = $request->input('highlights');
        $category->tools = $request->input('tools');
        $category->skills = $request->input('skills');
    
        $category->save();
    
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Category"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('msg', 'Category Deleted Successfully!');
    }
    
}
