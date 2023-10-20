<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordResets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'pwd' => 'required|min:8',
        ]);
    
        $userAvatar = $this->createAvatar($request->name);    
        $user = new User();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->avatar_image = $userAvatar;
        $user->password = bcrypt($request->pwd);
        $user->save();

       // return response()->json(['message' => 'Registration successful', 'user' => $user]);
        return redirect('/');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'pwd' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('pwd')])) {
           // return response()->json(['message' => 'Login successful', 'user' => Auth::user()]);
           return Redirect::to('/')->with('msg', 'Welcome -'.Auth::user()->name);
        }
        return Redirect::to('/')->with('error', 'Login Failed');
    }
    public function logout(Request $request) {
        Auth::logout();
        return Redirect::to('/')->with('msg', 'Log Out Successfully !');
    }
    public function createAvatar($name)
    {
        $words = explode(' ', $name);
        $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));

        // Define a background color and text color for the avatar
        $bgColor = '#'.substr(md5($name), 0, 6); // Use a unique color based on the name
        $textColor = '#ffffff'; // White text color

        // Create an image with the initials and colors
        $image = imagecreate(200, 200);
        $bg = imagecolorallocate($image, hexdec(substr($bgColor, 1, 2)), hexdec(substr($bgColor, 3, 2)), hexdec(substr($bgColor, 5, 2)));
        $text = imagecolorallocate($image, hexdec(substr($textColor, 1, 2)), hexdec(substr($textColor, 3, 2)), hexdec(substr($textColor, 5, 2)));
        imagefill($image, 0, 0, $bg);
        imagettftext($image, 75, 0, 25, 130, $text, public_path('/assets/fonts/arial.ttf'), $initials);

        // Save the image to a file
        $name = str_replace(' ', '_', $name);
        $avatarPath = '/assets/avatars/'.$name.'_avatar.png';
        imagepng($image, public_path($avatarPath));
        imagedestroy($image);

        return asset($avatarPath);
    }

    public function validatePasswordRequest(Request $request){
        // $user = DB::table('users')->where('email', '=', $request->email)->first();
        $users = User::where('email', '=', $request->input('email',''))->first();
        //Check if the user exists
        if (count($user) < 1) {
            return redirect()->back()->with('error','User does not exist');
        }

        //Create Password Reset Token
        // DB::table('password_resets')->insert([
        //     'email' => $request->email,
        //     'token' => Str::random(16),
        //     'created_at' => Carbon::now()
        // ]);
        PasswordResets::updateOrCreate([
            'email'   =>$request->input('email',''),
        ],[
            'email' => $request->input('email',''),
                'token' => Str::random(16),
                'created_at' => Carbon::now() 
        ]);
        //Get the token just created above
        $tokenData = PasswordResets::where('email', $request->input('email',''))->first();
        //dd($tokenData);

        if ($this->sendResetEmail($request->email, $tokenData['token'])) {
            $link = config('base_url') . '/reset/password/'.$tokenData['token'].'?email='.urlencode($request->email);
            return redirect()->back()->with('msg_focus','A reset link has been sent to your email address.<a href="'.$link.'">Click Here</a>');
        } else {
            return redirect()->back()->with('error','A Network Error occurred. Please try again.');
        }
    }
    private function sendResetEmail($email, $token)
    {
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('firstname', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = '/reset/password/'.$token . '?email='.urlencode($user['email']);

        try {
        //Here send the link with CURL with an external email API 
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function resetPassword(Request $request)
    {
        //Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'token' => 'required' ]);

        //check if payload is valid before moving on
        if ($validator->fails()) {
            return redirect()->back()->with('error' , 'Please complete the form');
        }

        $password = $request->password;
        // Validate the token
        $tokenData = DB::table('password_resets')
        ->where('token', $request->token)->first();
        // Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData)  return Redirect::to('/')->with('error', 'Token Expired !');

        $user = User::where('email', $tokenData['email'])->first();
        // Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->width('error','Email not found');
        //Hash and update the new password
        $user->password = Hash::make($password);
        $user->update(); //or $user->save();

        //login the user immediately they change password successfully
        Auth::login($user);

        //Delete the token
        DB::table('password_resets')->where('email', $user['email'])
        ->delete();

        //Send Email Reset Success Email
        return Redirect::to('/')->with('msg', 'Password Reset Successfully !');

    }
    public function resetPasswordForm(Request $request, $token){
        $userToken = trim($token);
        $email = $request->email;
        $token = $userToken;
        $data=[
            'user_email'=>!empty($email) ? $email : '',
            'token'=>!empty($token) ? $token : ''
        ];
        return view('auth.reset_password',$data);
    }
}
