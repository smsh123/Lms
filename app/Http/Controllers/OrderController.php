<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Course;

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
    
        $order = new Order;
        $order->product_type = $request->input('product_type');
        $order->product_name = $request->input('product_name');
        $order->product_id = $request->input('product_id');
        $order->price = $request->input('price');
        $order->discount = $request->input('discount');
        $order->coupon = $request->input('coupon');
        $order->amount = $request->input('amount');
        $order->status = !empty($request->input('status')) ? $request->input('status') : 'created';
        $order->user_details = [
            'full_name'=> !empty($request->input('user_full_name')) ? $request->input('user_full_name') : '',
            'mobile'=> !empty($request->input('user_mobile')) ? $request->input('user_mobile') : '',
            'email'=> !empty($request->input('user_email')) ? $request->input('user_email') : '',
            'state'=> !empty($request->input('state')) ? $request->input('state') : '',
            'city'=> !empty($request->input('city')) ? $request->input('city') : ''
        ];

        $order->save();
    
        return redirect()->back()->with('success', 'Order created successfully');
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
        
        return view('orders.add_to_cart')->with('product_description',!empty($productDescription) ? $productDescription : []);
    }

    public function edit(Request $request, $id) {
        $order = Order::find($id);
        // dd($course);
        return view('cms.orders.edit')->with('order',$order);
    }
    public function update(Request $request)
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
    
        $id = $request->input("id",'');
        $order = Order::find($id);
        $order->product_type = $request->input('product_type');
        $order->product_name = $request->input('product_name');
        $order->product_id = $request->input('product_id');
        $order->price = $request->input('price');
        $order->discount = $request->input('discount');
        $order->coupon = $request->input('coupon');
        $order->amount = $request->input('amount');
        $order->status = !empty($request->input('status')) ? $request->input('status') : 'created';
        $order->user_details[] = [];
        $order->user_details['full_name'] = !empty($request->input('user_full_name')) ? $request->input('user_full_name') : '';
        $order->user_details['mobile'] = $request->input('user_mobile');
        $order->user_details['email'] = $request->input('user_email');
        $order->user_details['state'] = $request->input('state');
        $order->user_details['city'] = $request->input('city');

        $order->save();
    
        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }
    
}
