<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MappingController extends Controller
{
    public function listing(Request $request){
        return view('cms.mappings.index');
    }
    
}
