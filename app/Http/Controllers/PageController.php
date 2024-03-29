<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Page;

class PageController extends Controller
{
    public function index(Request $request){
        if(!User::hasPermissions(["View Page"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->name)) {
            $Pages = Page::searchByFields(['name' => $request->name]);
        } elseif (!empty($request->slug)) {
            $Pages = Page::searchByFields(['slug' => $request->slug]);
        }else {
            $Pages = Page::paginateWithDefault(10);
        }

        return view('cms.pages.index')->with('pages',$Pages);
    }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Page"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $users = User::all();
        $data=[
            'users' => !empty($users) ? $users : [],
            'page_group' => 'user'
        ];
        return view('cms.pages.add',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'slug'=> 'required|string|max:255|unique:pages',
        ]);
    
        $page = new Page;
        $page->name = $request->input('name');
        $page->name_hindi = $request->input('name_hindi');
        $page->meta_title = $request->input('meta_title');
        $page->meta_keywords = $request->input('meta_keywords');
        $page->meta_description = $request->input('meta_description');
        $page->slug = $request->input('slug');
        $page->description = $request->input('description');
        $page->synopsis = $request->input('synopsis');
        $page->author = $request->input('author');
        $page->is_public = 0;
    
        $page->save();
    
        return redirect()->route('pages.index')->with('success', 'Blog created successfully');
    }
    public function listing(Request $request){

        $pages = Page::getActivePages();
        $data=[
            "pages"=>!empty($pages) ? $pages : [] 
        ];
        return view('pages.directory',$data);
    }
    public function pageBySlug(Request $request){
        $request_uri= explode("/",$request->url());
        $slug = $request_uri[count($request_uri) - 1];
        $pages = Page::getPageBySlug($slug);
        if(empty($pages)){
            abort(404);
        }
        $data = [
            "page_content" => !empty($pages) ? $pages[0] : []
        ];
        return view('pages.index', $data);
    }

    public function pageEdit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Page"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $pages = Page::find($id);
        $users = User::all();
        $data=[
            'users' => !empty($users) ? $users : [],
            'pages' => !empty($pages) ? $pages : [],
            'page_group' => 'user'
        ];
        // dd($course);
        return view('cms.pages.edit', $data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'slug'=> 'required|string|max:255|unique:pages',
        ]);
        $id = $request->input("id");
        $page = Page::find($id);
        $page->name = $request->input('name');
        $page->name_hindi = $request->input('name_hindi');
        $page->meta_title = $request->input('meta_title');
        $page->meta_keywords = $request->input('meta_keywords');
        $page->meta_description = $request->input('meta_description');
        $page->description = $request->input('description');
        $page->synopsis = $request->input('synopsis');
        $page->author = $request->input('author');
    
        $page->save();
    
        return redirect()->route('pages.index')->with('success', 'Page updated successfully');
    }

    public function changeStatus(Request $request, $id) {
        if(!empty($id)){
            $page = Page::find($id);
            $status = !empty($page->is_public) ? $page->is_public : 0 ;
            if($status == 1){
                $page->is_public = 0;
                $page->save();
                return redirect()->back()->with('success', 'Page unpublished successfully');
            } elseif($status == 0){
                $page->is_public = 1;
                $page->save();
                return redirect()->back()->with('success', 'Page published successfully');
            }
        }else{
            abort(404);
        }
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Page"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $page = Page::find($id);
        $page->delete();
        return redirect()->back()->with('msg', 'Page Deleted Successfully!');
    }

    
}
