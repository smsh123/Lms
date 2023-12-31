<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\User;

class PermissionController extends Controller
{
    //
    public function index(Request $request){
        $permissions = Permission::paginateWithDefault(10);
        $data = [
            'permissions'=>!empty($permissions) ? $permissions : []
        ];
        return view('cms.permissions.index',$data);
    }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Permission"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        return view('cms.permissions.add');
    }
    public function edit(Request $request,$id){
        if(!User::hasPermissions(["Edit Permission"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $role = Permission::find($id);
        return view('cms.permissions.edit')->with('role',$role);
    }
    public function store(Request $request){
            $this->validate($request, [
            'name' => 'required',
            ]);

        $permission = Permission::find($request->input('_id',''));

        if ($permission) {
            $permission->name = $request->name;
            $permission->save();
        } else {
            $permission = new Permission();
            $permission->name = $request->name;
            $permission->save();
        }
        return redirect('/cms/permissions')->with('msg', 'Permission Registered Successfully!');
    }
    public function delete(Request $request,$id){
        if(!User::hasPermissions(["Delete Permission"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $role = Permission::find($id); 
        if ($role) {
            $role->delete(); 
        } else {
            return redirect('/cms/permissions')->with('msg', 'No Permission found by this id!');
        }
        return redirect('/cms/permissions')->with('msg', 'Permission Deleted Successfully!');
    } 
}
