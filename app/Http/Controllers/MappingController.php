<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MappingController extends Controller
{
    public function listing(Request $request){
        if(!User::hasPermissions(["Manage Mapping"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        return view('cms.mappings.index');
    }
    
}
