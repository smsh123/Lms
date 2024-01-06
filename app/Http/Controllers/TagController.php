<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;

class TagController extends Controller
{
    //
    public function index(Request $request, $tag){
        $tag = !empty($tag) ? str_replace('_',' ',$tag) : '';
        $data = [
            'tag' => !empty($tag) ? $tag : '',
        ];
        return view('tags.index',$data);
    }
    
}
