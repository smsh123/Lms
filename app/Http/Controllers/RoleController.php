<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
// use App\Models\User;

class RoleController extends Controller
{
    //
    public function index(Request $request){
        // dd(Role::roleHasPermission("Create:User1"),User::hasPermission("Create:User"));
        $roles = Role::all();
        $data = [
            'roles'=>!empty($roles) ? $roles : []
        ];
        return view('cms.roles.index',$data);
    }
    public function add(Request $request){
        return view('cms.roles.add');
    }
    public function edit(Request $request,$id){
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
        $role = Role::find($id); 
        if ($role) {
            $role->delete(); 
        } else {
            return redirect('/cms/roles')->with('msg', 'No Role found by this id!');
        }
        return redirect('/cms/roles')->with('msg', 'Role Deleted Successfully!');
    } 
}