<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    //
    public function index(Request $request){
        if(!User::hasPermissions(["View Role"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        // dd(Role::roleHasPermission("Create:User1"),User::hasPermissions(["Create:User"]));
        $roles = Role::paginateWithDefault(10);
        $data = [
            'roles'=>!empty($roles) ? $roles : []
        ];
        return view('cms.roles.index',$data);
    }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Role"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $data = [
            'page_group' => 'role'
        ];
        return view('cms.roles.add',$data);
    }
    public function edit(Request $request,$id){
        if(!User::hasPermissions(["Edit Role"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $role = Role::find($id);
        $data = [
            'page_group' => 'role',
            'role' => $role
        ];
        return view('cms.roles.edit',$data);
    }
    public function store(Request $request){
            $this->validate($request, [
            'name' => 'required',
            ]);

        $role = Role::find($request->input('_id',''));

        if ($role) {
            $role->name = $request->name;
            $role->save();
        } else {
            $role = new Role();
            $role->name = $request->name;
            $role->save();
        }
        return redirect('/cms/roles')->with('msg', 'Role Registered Successfully!');
    }
    public function delete(Request $request,$id){
        if(!User::hasPermissions(["Delete Role"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $role = Role::find($id); 
        if ($role) {
            $role->delete(); 
        } else {
            return redirect('/cms/roles')->with('msg', 'No Role found by this id!');
        }
        return redirect('/cms/roles')->with('msg', 'Role Deleted Successfully!');
    } 
}