<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CourseController extends Controller
{
    //
    public function index(Request $request){
        return view('cms.courses.index');
      }
    public function add(Request $request){
    return view('cms.courses.add');
    }
    public function store(Request $request){
        dd($request->all());
        return view('cms.courses.add');
    }  
}
