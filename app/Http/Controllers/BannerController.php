<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banner;

class BannerController extends Controller
{
    public function store(Request $request)
    {
         //return $request->all();
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required',
            'live_from' => 'required',
            'live_till' => 'required',
            'banner_type' => 'required'
        ]);
  
        $banner = new Banner();
        $banner->name = $request->input('name');
        $banner->image = $request->input('image');
        $banner->live_from = $request->input('live_from');
        $banner->live_till = $request->input('live_till');
        $banner->banner_type = $request->input('banner_type');
        $banner->save();
        return redirect()->back()->with('msg', 'Banner Added Successfully!');
    }
    public function listBanners(Request $request){
        $banners = Banner::all();
        $data = [
            'banners'=>!empty($banners) ? $banners : []
        ];
        return view('cms.banners.index',$data);
    }
    public function addBanners(Request $request){
        if(!in_array('Add Banner',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        return view('cms.banners.add');
    }

    public function destroy($id)
    {
        if(!in_array('Delete Banner',\Auth::user()->permissions)){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->back()->with('msg', 'Banner Deleted Successfully!');
    }
    
}
