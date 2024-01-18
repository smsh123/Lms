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
        if(!User::hasPermissions(["View Banner"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $banners = Banner::paginateWithDefault(10);
        $data = [
            'banners'=>!empty($banners) ? $banners : []
        ];
        return view('cms.banners.index',$data);
    }
    public function addBanners(Request $request){
        if(!User::hasPermissions(["Add Banner"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $data = [
            'page_group' => 'coupon'
        ];
        return view('cms.banners.add',$data);
    }

    public function changeStatus(Request $request, $id) {
        if(!empty($id)){
            $banner = Banner::find($id);
            $status = !empty($banner->is_public) ? $banner->is_public : 0 ;
            if($status == 1){
                $banner->is_public = 0;
                $banner->save();
                return redirect()->back()->with('success', 'Banner unpublished successfully');
            } elseif($status == 0){
                $banner->is_public = 1;
                $banner->save();
                return redirect()->back()->with('success', 'Banner published successfully');
            }
        }else{
            abort(404);
        }
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Banner"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->back()->with('msg', 'Banner Deleted Successfully!');
    }
    
}
