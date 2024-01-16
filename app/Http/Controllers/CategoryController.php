<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index(Request $request){

        if(!User::hasPermissions(["View Category"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->name)) {
            $categories = Category::searchByFields(['name' => $request->name]);
        } elseif(!empty($request->slug)){
            $categories = Category::searchByFields(['slug' => $request->slug]);
        } else {
            $categories = Category::paginateWithDefault(10);
        }

        
        return view('cms.categories.index')->with('categories',$categories);
    }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Category"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }

        $data = [
            'page_group' => 'category'
        ];
        
        return view('cms.categories.add',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'slug'=> 'required|string|max:255|unique:categories',
        ]);
    
        $category = new Category;
        $category->name = $request->input('name');
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_description = $request->input('meta_description');
        $category->name_hindi = $request->input('name_hindi');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->synopsis = $request->input('synopsis');
        $category->thumbnail_image = $request->input('thumbnail_image');
        $category->banner_image = $request->input('banner_image');
    
        $category->save();
    
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }
    public function categories(Request $request){
        $categories = Category::getActiveCategories();
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
            'page_group' => 'category'
        ];
        return view('cms.categories.edit',$data);
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
        $category = Category::find($id);
        
        $category->name = $request->input('name');
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_description = $request->input('meta_description');
        $category->name_hindi = $request->input('name_hindi');
        $category->description = $request->input('description');
        $category->synopsis = $request->input('synopsis');
        $category->thumbnail_image = $request->input('thumbnail_image');
        $category->banner_image = $request->input('banner_image');
    
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
