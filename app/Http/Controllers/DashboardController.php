<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

   public function index(Request $request){
        return view('cms.dashboard');
   }
   public function courses(Request $request){
    return view('cms.courses.index');
  }
  public function courseCreate(Request $request){
    return view('cms.courses.add');
  }
  public function courseEdit(Request $request){
    return view('cms.courses.add');
  }
  public function courseDelete(Request $request){
    return view('cms.courses.add');
  }
  public function courseViewStatus(Request $request){
    return view('cms.courses.add');
  }
 
}