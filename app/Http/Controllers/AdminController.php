<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request; 

class AdminController extends Controller
{

   public function index(Request $request){
        return view('cms.dashboard');
   }
   public function courses(Request $request){
    return view('cms.courses.index');
  }
}