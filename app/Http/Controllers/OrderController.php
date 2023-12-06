<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Course;
use App\Helpers\SiteHelper;
use App\Models\Coupon;

class OrderController extends Controller
{
    //
    public function index(Request $request){

        $orders = Order::all();
        return view('cms.orders.index')->with('orders',$orders);
    }
    public function add(Request $request){
    return view('cms.orders.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_type' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'user_email' => 'required|string|max:255',
            'user_mobile' => 'required|numeric|min:1',
            'product_id' => 'required|string',
            'price' => 'required|numeric|min:1',
            'amount' => 'required|numeric|min:1',
            'status'=> 'required|string|max:255',
        ]);
        $product_id = $request->input('product_id');
        $product_type = $request->input('product_type');
        if((!empty($product_type) && $product_type == 'course') && !empty($product_id)){
            $productDescription = Course::find($product_id);
        }else{
            abort(404);
        }
        $email = !empty($request->input('user_email')) ? $request->input('user_email') : '';
        $mobile =  !empty($request->input('user_mobile')) ? $request->input('user_mobile') : '';
        $oldUser = User::where('email', $email)->orWhere('mobile', $mobile)->first();
        if(empty($oldUser)){
            $user = new User;
            $user->name = !empty($request->input('user_full_name')) ? $request->input('user_full_name') : '';
            $user->mobile =  $mobile;
            $user->email = $email;
            $user->user_type = !empty($request ->user_type) ? $request ->user_type : 'external';
            $user->user_role = !empty($request ->user_role) ? $request ->user_role : 'Student';
            $user->save();
            $user = User::where('email', $email)->orWhere('mobile', $mobile)->first();
        }
        if(!empty($oldUser)){
            $userId = !empty($oldUser['_id']) ? $oldUser['_id'] : '' ;
        }elseif($user){
            $userId = !empty($user['_id']) ? $user['_id'] : '';
        }
        $order = new Order;
        $order->product_type = $request->input('product_type');
        $order->product_name = !empty($productDescription) && !empty($productDescription['name']) ? $productDescription['name'] : $request->input('product_name');
        $order->uid = SiteHelper::generateRandomString();
        $order->product_id = !empty($productDescription) && !empty($productDescription['_id']) ? $productDescription['_id'] : $request->input('product_id');
        $order->price = !empty($productDescription) && !empty($productDescription['selling_price']) ? (int) $productDescription['selling_price'] : (int) $request->input('price');
        $order->discount = (int) $request->input('discount');
        $order->coupon = $request->input('coupon');
        $order->amount = !empty($productDescription) && !empty($productDescription['selling_price']) ? (int) $productDescription['selling_price'] : (int) $request->input('amount');
        $order ->referrer = $request->input('referrer');
        $order->status = !empty($request->input('status')) ? $request->input('status') : 'created';
        $order->user_id = !empty($userId) ? $userId : ''; 
        $order->user_details = [
            'full_name'=> !empty($request->input('user_full_name')) ? $request->input('user_full_name') : '',
            'mobile'=> !empty($request->input('user_mobile')) ? (int) $request->input('user_mobile') : '',
            'email'=> !empty($request->input('user_email')) ? $request->input('user_email') : '',
            'state'=> !empty($request->input('state')) ? $request->input('state') : '',
            'city'=> !empty($request->input('city')) ? $request->input('city') : ''
        ];

        $order->save();

        $savedOrder = Order::getOrderByUID($order->uid);
        $data = [
            'saved_order' => !empty($savedOrder) ? $savedOrder[0] : [],
            'msg' => "Order Created Successfully"
        ];
        if(!empty($order ->referrer)){
            return $data;
        }else{
            return redirect()->back()->with('success', 'Order Created Successfully');
        }

    }
    public function addToCart(Request $request, $slug){
        $productType = $productId = '';
        $productDescription = [];
        $productType = $request->input('type');
        $productId = $request->input('id');
        if((!empty($productType) && $productType == 'course') && !empty($productId)){
            $productDescription = Course::find($productId);
        }else{
            abort(404);
        }
        if(!empty($productDescription)){
            $productDescription['productType'] = $productType;
        }else{
            abort(404);
        }
        
        $data = [
            "product_description"=>!empty($productDescription) ? $productDescription : []
        ];
        return view('orders.add_to_cart', $data);
    }

    public function edit(Request $request, $id) {
        $order = Order::find($id);
        // dd($course);
        return view('cms.orders.edit')->with('order',$order);
    }
    public function update(Request $request)
    {
        $id = $request->input("id",'');
        $order = Order::find($id);
        $order->discount = !empty($request->input('discount')) ? $request->input('discount') : '';
        $order->coupon = !empty($request->input('coupon')) ? $request->input('coupon') : '';
        $order->amount = !empty($request->input('amount')) ? $request->input('amount') : '';
        $order->status = !empty($request->input('status')) ? $request->input('status') : 'proceed';
        $order->save();
    
        return redirect()->back()->with('success', 'Order updated successfully');
    }


    public function applyCoupon(Request $request, $coupon , $orderId ='') {
        $coupon = Coupon::getCouponByCode($coupon);
        $orderId =  !empty($request->input('orderId')) ? $request->input('orderId') : '';
        $order = Order::find($orderId);
        $orderAmout = !empty($order) && $order['price'] ? $order['price'] : ''; 
        $couponValue = '';
        $status = 'Validating Coupon';
        $courseSlug = $request->input('slug');
        $courseSlug = 'digital-marketing-certification-program';
        if(!empty($coupon['status']) && $coupon['status'] == 'disable' ){
            return 'Invalid Coupon Code';
        }
        if((!empty($coupon['courses']) && is_array($coupon['courses']) && !(in_array($courseSlug, $coupon['courses']))) || (!empty($coupon['courses']) && $coupon['courses'] != $courseSlug)){
            return 'This coupon is not valid for this course!';
        }
        if(!empty($coupon['min_cart_value']) && $coupon['min_cart_value'] > $orderAmout){
            return 'Add more item in cart to avail discount';
        }
        $couponValue = !empty($coupon['coupon_value']) ? $coupon['coupon_value'] : 0;
        $maxDiscount = !empty($coupon['max_discount']) ? $coupon['max_discount'] : ''; 
        if(!empty($coupon['unit']) && $coupon['unit'] == "percent"){
            $couponValue =  $orderAmout * $couponValue / 100;
        }
        if(!empty($couponValue) && $couponValue > $maxDiscount){
            $couponValue = $maxDiscount;
        }

        if((!empty($coupon['type']) && $coupon['type'] == 'discount')){
            $amoutWithCoupon =  $orderAmout - $couponValue;
            $status = 'Applied';
            $msg = 'You Saved Rs-'.$couponValue.' with this order.';
            $data = [
                "status" => $status,
                "discount_value"=> !empty($couponValue) ? $couponValue : 0,
                "order_amount" => !empty($amoutWithCoupon) ? $amoutWithCoupon : $orderAmout,
                "display_msg" => !empty($msg) ? $msg : ''
            ];
            if(!empty($order)){
                $order->coupon_status = $status;
                $order ->discount = !empty($couponValue) ? $couponValue : 0;
                $order ->coupon = !empty($coupon['code']) ? $coupon['code'] : '';
                $order ->amount =  !empty($amoutWithCoupon) ? $amoutWithCoupon : $orderAmout;
                $order->save();
            }else{
                return 'You have not created any order yet. Please create an order first.';
            }
            return $data;

        }elseif((!empty($coupon['type']) && $coupon['type'] == 'cashback')){
            $amoutWithCoupon =  $orderAmout;
            $status = 'Cashback Added';
            $msg = 'Cashback Added of Rs-'.$couponValue.' with this order.';
            $data = [
                "status" => $status,
                "order_amount" => !empty($amoutWithCoupon) ? $amoutWithCoupon : $orderAmout,
                'cashback_amount' => !empty($couponValue) ? $couponValue : '', 
                "display_msg" => !empty($msg) ? $msg : ''
            ];
            if(!empty($order)){
                $order->coupon_status = $status;
                $order ->cashback = !empty($couponValue) ? $couponValue : 0;
                $order ->coupon = !empty($coupon['code']) ? $coupon['code'] : '';
                $order ->amount =  !empty($amoutWithCoupon) ? $amoutWithCoupon : $orderAmout;
                $order->save();
            }else{

                return 'You have not created any order yet. Please create an order first.';
            }
            return $data;
        }
        return 'something went wrong';
    }
    
    
}
