<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index(Request $request){
        $blogs =  Blog::all();
        $courses =  Course::all();
        $data = [
            'blogs' => !empty($blogs) ? $blogs : [],
            'courses' => !empty($courses) ? $courses :[] 
        ];
        return view('index', $data);
   }
}
