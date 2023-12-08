<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'pwd' => 'required|min:8',
        ]);

        $userAvatar = $request->avatar_image;
        if(empty($userAvatar)){
            // $userAvatar = $this->createAvatar($request->name);
            $userAvatar = "";
        }
        $user = new User();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->avatar_image = $userAvatar;
        $user->cover_image = $request ->cover_image;
        $user->password = bcrypt($request->pwd);
        $user->user_type = !empty($request ->user_type) ? $request ->user_type : 'external';
        $user->user_role = !empty($request ->user_role) ? $request ->user_role : 'Student';
        $user->save();
        return redirect()->back()->with('msg', 'User Registered Successfully!');
    }
    public function edit(Request $request, $id){
        $users = User::find($id);
        $data = [
            "users" => !empty($users) ? $users : []
        ];
        return view('cms.users.edit',$data);
    }
    public function update(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $id = $request->input("id",'');
        $userAvatar = $request->avatar_image;
        if(empty($userAvatar)){
            $userAvatar = $this->createAvatar($request->name);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->avatar_image = $userAvatar;
        if(!empty($request->pwd)){
            $user->password = bcrypt($request->pwd);
        }
        $user->cover_image = $request ->cover_image;
        $user->user_type = !empty($request ->user_type) ? $request ->user_type : 'external';
        $user->user_role = !empty($request ->user_role) ? $request ->user_role : 'Student';
        $user->save();
        return redirect()->back()->with('msg', 'User Details Updated Successfully!');
    }

    public function createAvatar($name)
    {
        $words = explode(' ', $name);
       // dd($words,$name);
        $initials = strtoupper(substr($words[0], 0, 1));
       

        // Define a background color and text color for the avatar
        $bgColor = '#'.substr(md5($name), 0, 6); // Use a unique color based on the name
        $textColor = '#ffffff'; // White text color

        // Create an image with the initials and colors
        $image = imagecreate(200, 200);
        $bg = imagecolorallocate($image, hexdec(substr($bgColor, 1, 2)), hexdec(substr($bgColor, 3, 2)), hexdec(substr($bgColor, 5, 2)));
        $text = imagecolorallocate($image, hexdec(substr($textColor, 1, 2)), hexdec(substr($textColor, 3, 2)), hexdec(substr($textColor, 5, 2)));
        imagefill($image, 0, 0, $bg);
        imagettftext($image, 75, 0, 70, 130, $text, public_path('/assets/fonts/arial.ttf'), $initials);

        // Save the image to a file
        $name = str_replace(' ', '_', $name);
        $avatarPath = '/assets/avatars/'.$name.'_avatar.png';
        imagepng($image, public_path($avatarPath));
        imagedestroy($image);

        return asset($avatarPath);
    }
    public function listUsers(Request $request){
        if(!User::hasPermissions(["Create:User"])){
            return response()->json(['error' => 'User has no permission to vew list'], 403);
        }
        $users = User::all();
        $data = [
            'users'=>!empty($users) ? $users : []
        ];
        return view('cms.users.index',$data);
    }
    public function addUsers(Request $request){
        return view('cms.users.add');
    }
    public function userRolesPermissions(Request $request,$id){
        $user = User::find($id);
        $data = [
            "_id" => $id,
            "roles" => Role::all(['name']),
            "permissions" => Permission::all('name'),
            "userPermissions" => !empty($user->permissions) ? $user->permissions : [],
            "userRoles" => !empty($user->roles) ? $user->roles : []
        ];
        return view('cms.users.permissions',$data);
    }
    public function storeUserRolesPermissions(Request $request){
        // dd($request->all());
        $user = User::find($request->input('_id',''));
        $user->roles = $request->input('roles',[]);
        $user->permissions = $request->input('permissions',[]);
        $user->save();
        return redirect('/cms/users')->with('msg', 'User Roles and Permissions Updated Successfully!');
    }
    
}
