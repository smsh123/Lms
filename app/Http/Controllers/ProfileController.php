<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function profile(Request $request, $id)
    {
        $isUserLoggedin = false;
        $isUserLoggedin = Auth::user();
        if($isUserLoggedin && $id == $isUserLoggedin->_id){
            $user_details = getUserDetailsById($isUserLoggedin->_id);
        }else{
            abort(404);
        }
        $data = [
            "profile_details" => !empty($user_details) ? $user_details : []
        ];
        return view ('profile.index',$data);
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
    public function editProfile(Request $request, $id)
    {
        $isUserLoggedin = false;
        $isUserLoggedin = Auth::user();
        if($isUserLoggedin && $id == $isUserLoggedin->_id){
            $user_details = getUserDetailsById($isUserLoggedin->_id);
        }else{
            abort(404);
        }
        $data = [
            "profile_details" => !empty($user_details) ? $user_details : []
        ];
        return view ('profile.edit',$data);
    }
    public function getSupport(Request $request)
    {
        return view ('profile.support');
    }
    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $id = $request->input("id", '');
        $userAvatar = $request->avatar_image;
        if (empty($userAvatar)) {
            $userAvatar = $this->createAvatar($request->name);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->avatar_image = $userAvatar;
        if (!empty($request->pwd)) {
            $user->password = bcrypt($request->pwd);
        }
        $user->cover_image = $request->cover_image;
        $user->save();
        return redirect()->back()->with('msg', 'Profile Details Updated Successfully!');
    }

    public function createAvatar($name)
    {
        $words = explode(' ', $name);
        $initials = strtoupper(substr($words[0], 0, 1));


        // Define a background color and text color for the avatar
        $bgColor = '#' . substr(md5($name), 0, 6); // Use a unique color based on the name
        $textColor = '#ffffff'; // White text color

        // Create an image with the initials and colors
        $image = imagecreate(200, 200);
        $bg = imagecolorallocate($image, hexdec(substr($bgColor, 1, 2)), hexdec(substr($bgColor, 3, 2)), hexdec(substr($bgColor, 5, 2)));
        $text = imagecolorallocate($image, hexdec(substr($textColor, 1, 2)), hexdec(substr($textColor, 3, 2)), hexdec(substr($textColor, 5, 2)));
        imagefill($image, 0, 0, $bg);
        imagettftext($image, 75, 0, 70, 130, $text, public_path('/assets/fonts/arial.ttf'), $initials);

        // Save the image to a file
        $name = str_replace(' ', '_', $name);
        $avatarPath = '/assets/avatars/' . $name . '_avatar.png';
        imagepng($image, public_path($avatarPath));
        imagedestroy($image);

        return asset($avatarPath);
    }
    
}
