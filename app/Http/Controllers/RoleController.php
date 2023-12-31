<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    //
    public function index(Request $request){
        // dd(Role::roleHasPermission("Create:User1"),User::hasPermissions(["Create:User"]));
        $roles = Role::paginateWithDefault(10);
        $data = [
            'roles'=>!empty($roles) ? $roles : []
        ];
        return view('cms.roles.index',$data);
    }
    public function add(Request $request){
        if(!in_array('Add Role',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        return view('cms.roles.add');
    }
    public function edit(Request $request,$id){
        if(!in_array('Edit Role',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $role = Role::find($id);
        return view('cms.roles.edit')->with('role',$role);
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
        if(!in_array('Delete Role',\Auth::user()->permissions)){
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