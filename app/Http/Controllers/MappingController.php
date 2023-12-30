<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MappingController extends Controller
{
    public function listing(Request $request){
        if(!in_array('Manage Mapping',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        return view('cms.mappings.index');
    }
    
}
