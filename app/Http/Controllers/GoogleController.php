<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\User;
use Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;


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
                $user = Auth::user();
                $token = JWTAuth::fromUser($user);
                // Store JWT token in a cookie
                $minutes = env('TOKEN_EXP', 86400); // Token time-to-live
                return Redirect::to('/')->withCookie(cookie()->make('login_token', $token, $minutes))->with('msg', 'Welcome - ' . $user->name);


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
                // return redirect()->back()->with('msg', 'User Registered Successfully!');

                Auth::login($user);
                $user = Auth::user();
                $token = JWTAuth::fromUser($user);
                // Store JWT token in a cookie
                $minutes = env('TOKEN_EXP', 86400); // Token time-to-live
                return Redirect::to('/')->withCookie(cookie()->make('login_token', $token, $minutes))->with('msg', 'Welcome - ' . $user->name);

                // return redirect('/');
            }
        } catch (Exception $e) {
            dd("exception", $e->getMessage());
        }
    }
}
