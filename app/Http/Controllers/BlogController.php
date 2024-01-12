<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request){
        if(!User::hasPermissions(["View Blog"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->name)) {
            $Blogs = Blog::searchByFields(['name' => $request->name]);
        } elseif(!empty($request->slug)){
            $Blogs = Blog::searchByFields(['slug' => $request->slug]);
        } else {
            $Blogs = Blog::paginateWithDefault(10);
        }
        
        return view('cms.blog.index')->with('blogs',$Blogs);
    }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Blog"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $categories = Category::all();
        $users = User::getUserByRole('Author');
        $data=[
            'users' => !empty($users) ? $users : [],
            'categories'=>!empty($categories) && is_object($categories) ? $categories->toArray() : [],
            'page_group' => 'blog'
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

        $loggedInUserId = Auth::user()->_id;
        $author = !empty($request->input('author')) ? $request->input('author') : $loggedInUserId;
    
        $blog = new Blog;
        $blog->category = $request->input('category');
        $blog->name = $request->input('name');
        $blog->name_hindi = $request->input('name_hindi');
        $blog->meta_title = $request->input('meta_title');
        $blog->meta_keywords = $request->input('meta_keywords');
        $blog->meta_description = $request->input('meta_description');
        $blog->slug = $request->input('slug');
        $blog->description = $request->input('description');
        $blog->synopsis = $request->input('synopsis');
        $blog->author = !empty($author) ? $author : '';
        $blog->tags = !empty($request->input('tags')) ? explode(',',$request->input('tags')) : [];
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
        $blogs = Blog::all();
        $courses =  Course::all();
        $blogDescription = !empty($blogDescription) ? $blogDescription[0] : [];
        $authorId = !empty($blogDescription['author']) ? $blogDescription['author'] : ''; 
        $author = User::find($authorId);
        if(!empty($blogDescription['tags'])){
            if(is_array($blogDescription['tags'])){
                $tags = $blogDescription['tags'];
            }
            else{
                $tags = explode(',',$blogDescription['tags']);
            }
        }
        $data = [
            'BlogDescription' => !empty($blogDescription) ? $blogDescription : [],
            'courses' => !empty($courses) ? $courses : [], 
            'author' => !empty($author) ? $author : [],
            'blogs' => !empty($blogs) ? $blogs : [],
            'tags' => !empty($tags) ? $tags : [],
            'page_type' => 'blog-details-page' 
        ];
        return view('blog.details',$data);
    }

    public function blogEdit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Blog"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $blog = Blog::find($id);
        $users = User::getUserByRole('Author');
        $categories = Category::all();
        $data=[
            'users' => !empty($users) ? $users : [],
            'blogs' => !empty($blog) ? $blog : [],
            'categories'=>!empty($categories) && is_object($categories) ? $categories->toArray() : [],
            'page_group' => 'blog'
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

        $loggedInUserId = Auth::user()->_id;
        $author = !empty($request->input('author')) ? $request->input('author') : $loggedInUserId;

        $id = $request->input("id");
        $blog = Blog::find($id);
        $blog->category = $request->input('category');
        $blog->name = $request->input('name');
        $blog->name_hindi = $request->input('name_hindi');
        $blog->meta_title = $request->input('meta_title');
        $blog->meta_keywords = $request->input('meta_keywords');
        $blog->meta_description = $request->input('meta_description');
        $blog->description = $request->input('description');
        $blog->synopsis = $request->input('synopsis');
        $blog->author = !empty($author) ? $author : '';
        $blog->tags = !empty($request->input('tags')) ? explode(',',$request->input('tags')) : [];
        $blog->thumbnail_image = $request->input('thumbnail_image');
        $blog->banner_image = $request->input('banner_image');
    
        $blog->save();
    
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Blog"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $blog = Blog::find($id);
        $blog->delete();
        return redirect()->back()->with('msg', 'Blog Deleted Successfully!');
    }
    
}
