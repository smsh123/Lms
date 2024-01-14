<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseModuleMapping;
use App\Models\Module;
use App\Models\Category;
use App\Models\Tool;
use Socialite;
use Auth;
use Exception;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $googleUser->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/');
            } else {

                $user = new User();
                $user->name = $googleUser->name;
                $user->mobile = "";
                $user->email = $googleUser->email;
                $user->avatar_image = $googleUser->avatar;
                $user->cover_image = $googleUser->avatar_original;
                $user->password = "";
                $user->user_type = 'external';
                $user->roles = [];
                $user->facebook_profile = '';
                $user->x_profile = '';
                $user->linkedin_profile = '';
                $user->youtube_profile = '';
                $user->instagram = '';
                $user->other_profile = '';
                $user->expertise = '';
                $user->qualification = '';
                $user->google_id = $googleUser->id ?? '';
                $user->permissions = [];
                $user->save();
                return redirect()->back()->with('msg', 'User Registered Successfully!');

                Auth::login($user);

                return redirect('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
