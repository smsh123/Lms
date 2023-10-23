<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required',
            'live_from' => 'required',
            'live_till' => 'required',
            'banner_type' => 'required'
        ]);
  
        $banner = new Banner();
        $banner->name = $request->name;
        $banner->image = $request->image;
        $banner->live_from = $request->live_from;
        $banner->live_till = $request->live_end;
        $banner->banner_type = $request->banner_type;
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
        return view('cms.banners.add');
    }
    
}
