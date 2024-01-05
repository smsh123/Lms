<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Brand;

class BrandController extends Controller
{
    //
    public function index(Request $request){
        if(!User::hasPermissions(["View Brand"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }

        $brands = Brand::paginateWithDefault(10);
        return view('cms.brands.index')->with('brands',$brands);
    }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Brands"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        
        return view('cms.brands.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'slug'=> 'required|string|max:255|unique:brands',
        ]);
    
        $brand = new Brand;
        $brand->name = $request->input('name');
        $brand->name_hindi = $request->input('name_hindi');
        $brand->slug = $request->input('slug');
        $brand->description = $request->input('description');
        $brand->synopsis = $request->input('synopsis');
        $brand->logo = $request->input('thumbnail_image');
        $brand->banner_image = $request->input('banner_image');
        $brand->facebook = $request->input('facebook');
        $brand->twitter = $request->input('twitter');
        $brand->youtube = $request->input('youtube');
        $brand->instagram = $request->input('instagram');
        $brand->linkedin = $request->input('linkedin');
        $brand->phone = $request->input('phone');
        $brand->support_number = $request->input('support_number');
        $brand->email = $request->input('email');
        $brand->support_email = $request->input('support_email');
        $brand->address = $request->input('address');
        $brand->website = $request->input('website');
    
        $brand->save();
    
        return redirect()->route('brands.index')->with('success', 'Brand created successfully');
    }

    public function edit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Brands"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
       
        $brands = Brand::find($id);
        $data = [
            'brands' => !empty($brands) ? $brands : [],
        ];
        return view('cms.brands.edit',$data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_hindi' => 'required|string|max:255',
            'description' => 'required|string',
            'slug'=> 'required|string|max:255',
        ]);
        $id = $request->input("id",'');
        $brand = Brand::find($id);
        
        $brand->description = $request->input('description');
        $brand->synopsis = $request->input('synopsis');
        $brand->logo = $request->input('thumbnail_image');
        $brand->banner_image = $request->input('banner_image');
        $brand->facebook = $request->input('facebook');
        $brand->twitter = $request->input('twitter');
        $brand->youtube = $request->input('youtube');
        $brand->instagram = $request->input('instagram');
        $brand->linkedin = $request->input('linkedin');
        $brand->phone = $request->input('phone');
        $brand->support_number = $request->input('support_number');
        $brand->email = $request->input('email');
        $brand->support_email = $request->input('support_email');
        $brand->address = $request->input('address');
        $brand->website = $request->input('website');
    
        $brand->save();
    
        return redirect()->route('brands.index')->with('success', 'Brand updated successfully');
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Brand"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $brand = Brand::find($id);
        $brand->delete();
        return redirect()->back()->with('msg', 'Brand Deleted Successfully!');
    }
    
}
