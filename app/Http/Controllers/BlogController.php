<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index(Request $request){
        $Blogs = Blog::paginateWithDefault(10);
        return view('cms.blog.index')->with('blogs',$Blogs);
    }
    public function add(Request $request){
        if(!in_array('Add Blog',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $users = User::getUserByRole('Author');
        $data=[
            'users' => !empty($users) ? $users : []
        ];
        return view('cms.blog.add',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'slug'=> 'required|string|max:255|unique:blogs',
        ]);
    
        $blog = new Blog;
        $blog->name = $request->input('name');
        $blog->name_hindi = $request->input('name_hindi');
        $blog->meta_title = $request->input('meta_title');
        $blog->meta_keywords = $request->input('meta_keywords');
        $blog->meta_description = $request->input('meta_description');
        $blog->slug = $request->input('slug');
        $blog->description = $request->input('description');
        $blog->synopsis = $request->input('synopsis');
        $blog->author = $request->input('author');
        $blog->tags = $request->input('tags');
        $blog->thumbnail_image = $request->input('thumbnail_image');
        $blog->banner_image = $request->input('banner_image');
    
        $blog->save();
    
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully');
    }
    public function listing(Request $request){

        $Blogs = Blog::all();
        $data = [
            'blogs' => !empty($Blogs) ? $Blogs : [],
            'meta_title'=>'Career oriented stories | Aryabhatt Classes',
            'meta_keywords'=>'career, aryabhatt stories, aryabhatt classes, blogs, stories, job news, job updates',
            'meta_description'=>'Authors at aryabhatt classes writes veriety of stories to keep you updated with latest career news and latest job updates.',
            'page_type' => 'blog-page' 
        ];
        return view('blog.index',$data);
    }
    public function blogDetails(Request $request, $slug){
        $blogDescription = [];
        $blogDescription = Blog::getBlogBySlug($slug);
        $data = [
            'BlogDescription' => !empty($blogDescription) ? $blogDescription[0] : [],
            'page_type' => 'blog-details-page' 
        ];
        return view('blog.details',$data);
    }

    public function blogEdit(Request $request, $id) {
        if(!in_array('Edit Blog',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $blog = Blog::find($id);
        $users = User::getUserByRole('Author');
        $data=[
            'users' => !empty($users) ? $users : [],
            'blogs' => !empty($blog) ? $blog : []
        ];
        // dd($course);
        return view('cms.blog.edit', $data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $id = $request->input("id");
        $blog = Blog::find($id);
        $blog->name = $request->input('name');
        $blog->name_hindi = $request->input('name_hindi');
        $blog->meta_title = $request->input('meta_title');
        $blog->meta_keywords = $request->input('meta_keywords');
        $blog->meta_description = $request->input('meta_description');
        $blog->description = $request->input('description');
        $blog->synopsis = $request->input('synopsis');
        $blog->author = $request->input('author');
        $blog->tags = $request->input('tags');
        $blog->thumbnail_image = $request->input('thumbnail_image');
        $blog->banner_image = $request->input('banner_image');
    
        $blog->save();
    
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy($id)
    {
        if(!in_array('Delete Blog',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->back()->with('msg', 'Blog Deleted Successfully!');
    }
    
}
