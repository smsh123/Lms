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
        $users = User::all();
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
        $blog->slug = $request->input('slug');
        $blog->description = $request->input('description');
        $blog->synopsis = $request->input('synopsis');
        $blog->author = $request->input('author');
        $blog->tags = $request->input('tags');
    
        $blog->save();
    
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully');
    }
    public function listing(Request $request){

        $Blogs = Blog::all();
        return view('blog.index')->with('blogs',$Blogs);
    }
    public function blogDetails(Request $request, $slug){
        $blogDescription = [];
        $blogDescription = Blog::getBlogBySlug($slug);
        return view('blog.details')->with('BlogDescription',!empty($blogDescription) ? $blogDescription[0] : []);
    }

    public function blogEdit(Request $request, $id) {
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
        $blog->description = $request->input('description');
        $blog->synopsis = $request->input('synopsis');
        $blog->author = $request->input('author');
        $blog->tags = $request->input('tags');
    
        $blog->save();
    
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }
    
}
