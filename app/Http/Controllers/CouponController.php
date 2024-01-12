<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\User;

class CouponController extends Controller
{
    //
    public function index(Request $request){
        if(!User::hasPermissions(["View Coupon"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->code)) {
           $coupons =Coupon::searchByFields(['code' => $request->code]);
        } elseif(!empty($request->unit)){
           $coupons =Coupon::searchByFields(['unit' => $request->unit]);
        }elseif(!empty($request->type)){
           $coupons =Coupon::searchByFields(['type' => $request->type]);
        } else {
            $coupons =Coupon::paginateWithDefault(10);
        }
        
        return view('cms.coupons.index')->with('coupons',$coupons);
      }
    public function add(Request $request){
        if(!User::hasPermissions(["Add Coupon"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $courses = Course::all();
        $data = [
            'courses' => !empty($courses) ? $courses : [] ,
            'page_group' => 'coupon'
        ];
        return view('cms.coupons.add',$data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'courses' => 'required',
            'code' => 'required|string|max:10|unique:coupons',
            'type' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'coupon_value' => 'required|string|max:255',
            'status' => 'required|string|max:255'
        ]);
    
        $coupon = new Coupon;
        $coupon->courses = $request->input('courses');
        $coupon->code = $request->input('code');
        $coupon->type = $request->input('type');
        $coupon->unit = $request->input('unit');
        $coupon->coupon_value = $request->input('coupon_value');
        $coupon->start_date = $request->input('start_date');
        $coupon->end_date = $request->input('end_date');
        $coupon->max_discount = $request->input('max_discount');
        $coupon->min_cart_value = $request->input('min_cart_value');
        $coupon->coupon_limit = $request->input('coupon_limit');
        $coupon->status = $request->input('status');
       
    
        $coupon->save();
    
        return redirect()->route('coupons.index')->with('msg', 'Coupon created successfully');
    }

    public function couponEdit(Request $request, $id) {
        if(!User::hasPermissions(["Edit Coupon"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $coupons =Coupon::find($id);
        $courses = Course::all();
        // dd($coupons);
        $data = [
            "coupons" => $coupons,
            "courses" => !empty($courses) ? $courses : [],
            'page_group' => 'coupon'
        ];
        return view('cms.coupons.edit',$data);
    }
    public function update(Request $request)
    {
        $request->validate([
            'courses' => 'required',
            'code' => 'required|string|max:10',
            'type' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'coupon_value' => 'required|string|max:255',
            'status' => 'required|string|max:255'
        ]);

        $id = $request->input("id",'');
        $coupon = Coupon::find($id);
        $coupon->courses = $request->input('courses');
        $coupon->code = $request->input('code');
        $coupon->type = $request->input('type');
        $coupon->unit = $request->input('unit');
        $coupon->coupon_value = $request->input('coupon_value');
        $coupon->start_date = $request->input('start_date');
        $coupon->end_date = $request->input('end_date');
        $coupon->max_discount = $request->input('max_discount');
        $coupon->min_cart_value = $request->input('min_cart_value');
        $coupon->coupon_limit = $request->input('coupon_limit');
        $coupon->status = $request->input('status');
        $coupon->save();
    
        return redirect()->route('coupons.index')->with('msg', 'Coupon updated successfully');
    }

    public function destroy($id)
    {
        if(!User::hasPermissions(["Delete Coupon"])){
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->back()->with('msg', 'Coupon Deleted Successfully!');
    }
    
}
