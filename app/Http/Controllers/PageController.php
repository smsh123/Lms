<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Page;

class PageController extends Controller
{
    public function index(Request $request){
        $Pages = Page::all();
        return view('cms.pages.index')->with('pages',$Pages);
    }
    public function add(Request $request){
        $users = User::all();
        $data=[
            'users' => !empty($users) ? $users : []
        ];
        return view('cms.pages.add',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'slug'=> 'required|string|max:255|unique:blogs',
        ]);
    
        $page = new Page;
        $page->name = $request->input('name');
        $page->name_hindi = $request->input('name_hindi');
        $page->slug = $request->input('slug');
        $page->description = $request->input('description');
        $page->synopsis = $request->input('synopsis');
        $page->author = $request->input('author');
    
        $page->save();
    
        return redirect()->route('pages.index')->with('success', 'Blog created successfully');
    }
    public function listing(Request $request){

        $Pages = Page::all();
        return view('pages.index')->with('pages',$Pages);
    }

    public function pageEdit(Request $request, $id) {
        $pages = Page::find($id);
        $users = User::all();
        $data=[
            'users' => !empty($users) ? $users : [],
            'pages' => !empty($pages) ? $pages : []
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
            'slug'=> 'required|string|max:255',
        ]);
        $id = $request->input("id");
        $page = Page::find($id);
        $page->name = $request->input('name');
        $page->name_hindi = $request->input('name_hindi');
        $page->slug = $request->input('slug');
        $page->description = $request->input('description');
        $page->synopsis = $request->input('synopsis');
        $page->author = $request->input('author');
    
        $page->save();
    
        return redirect()->route('pages.index')->with('success', 'Page updated successfully');
    }
    
}
