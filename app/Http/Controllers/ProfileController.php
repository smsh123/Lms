<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function profile(Request $request)
    {
        return view ('profile.index');
    }
    public function courses(Request $request)
    {
        return view ('profile.courses');
    }
    public function orders(Request $request)
    {
        return view ('profile.orders');
    }
    public function reports(Request $request)
    {
        return view ('profile.reports');
    }
    
}
