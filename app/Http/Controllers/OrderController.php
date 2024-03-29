<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Course;
use App\Helpers\SiteHelper;
use App\Models\Coupon;
use App\Models\Subscription;
use App\Models\Leads;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        if (!User::hasPermissions(["View Order"])) {
            return redirect()->back()->with('error', 'Permission Denied');
        }
        if (!empty($request->product_name)) {
            $orders = Order::searchByFields(['product_name' => $request->product_name]);
        } elseif (!empty($request->uid)) {
            $orders = Order::searchByFields(['uid' => $request->uid]);
        }elseif (!empty($request->status)) {
            $orders = Order::searchByFields(['status' => $request->status]);
        }else {
            $orders = Order::paginateWithDefault(10);
        }

        
        return view('cms.orders.index')->with('orders', $orders);
    }
    public function add(Request $request)
    {
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
            'status' => 'required|string|max:255',
        ]);
        $product_id = $request->input('product_id');
        $product_type = $request->input('product_type');
        if ((!empty($product_type) && $product_type == 'course') && !empty($product_id)) {
            $productDescription = Course::find($product_id);
        } else {
            abort(404);
        }
        $email = !empty($request->input('user_email')) ? $request->input('user_email') : '';
        $mobile =  !empty($request->input('user_mobile')) ? $request->input('user_mobile') : '';
        $oldUser = User::where('email', $email)->orWhere('mobile', $mobile)->first();
        if (empty($oldUser)) {
            $user = new User;
            $user->name = !empty($request->input('user_full_name')) ? $request->input('user_full_name') : '';
            $user->mobile =  $mobile;
            $user->email = $email;
            $user->user_type = !empty($request->user_type) ? $request->user_type : 'external';
            $user->user_role = !empty($request->user_role) ? $request->user_role : 'Student';
            $user->save();
            $user = User::where('email', $email)->orWhere('mobile', $mobile)->first();
        }
        if (!empty($oldUser)) {
            $userId = !empty($oldUser['_id']) ? $oldUser['_id'] : '';
        } elseif ($user) {
            $userId = !empty($user['_id']) ? $user['_id'] : '';
        }
        $order = new Order;
        $order->product_type = $request->input('product_type');
        $order->product_name = !empty($productDescription) && !empty($productDescription['name']) ? $productDescription['name'] : $request->input('product_name');
        $order->uid = generateRandomString();
        $order->product_id = !empty($productDescription) && !empty($productDescription['_id']) ? $productDescription['_id'] : $request->input('product_id');
        $order->price = !empty($productDescription) && !empty($productDescription['selling_price']) ? (int) $productDescription['selling_price'] : (int) $request->input('price');
        $order->discount = (int) $request->input('discount');
        $order->coupon = $request->input('coupon');
        $order->amount = !empty($productDescription) && !empty($productDescription['selling_price']) ? (int) $productDescription['selling_price'] : (int) $request->input('amount');
        $order->referrer = $request->input('referrer');
        $order->status = !empty($request->input('status')) ? $request->input('status') : 'created';
        $order->user_id = !empty($userId) ? $userId : '';
        $order->user_details = [
            'full_name' => !empty($request->input('user_full_name')) ? $request->input('user_full_name') : '',
            'mobile' => !empty($request->input('user_mobile')) ? (int) $request->input('user_mobile') : '',
            'email' => !empty($request->input('user_email')) ? $request->input('user_email') : '',
            'state' => !empty($request->input('state')) ? $request->input('state') : '',
            'city' => !empty($request->input('city')) ? $request->input('city') : ''
        ];

        $order->save();

        $lead = new Leads;
        $lead->name = !empty($request->input('user_full_name')) ? $request->input('user_full_name') : '';
        $lead->email = !empty($request->input('user_mobile')) ? (int) $request->input('user_mobile') : '';
        $lead->mobile = !empty($request->input('user_email')) ? $request->input('user_email') : '';
        $lead->course_interested = !empty($productDescription) && !empty($productDescription['name']) ? $productDescription['name'] : $request->input('product_name');
        $lead->synopsis = !empty($request->input('synopsis')) ? $request->input('synopsis') : '';
        $lead->status = !empty($request->input('status')) ? $request->input('status') : 'Active';
        $lead->save();
    

        $savedOrder = Order::getOrderByUID($order->uid);
        $data = [
            'saved_order' => !empty($savedOrder) ? $savedOrder[0] : [],
            'msg' => "Order Created Successfully"
        ];
        if (!empty($order->referrer)) {
            return $data;
        } else {
            return redirect()->back()->with('success', 'Order Created Successfully');
        }
    }
    public function addToCart(Request $request, $slug)
    {
        $productType = $productId = '';
        $productDescription = [];
        $productType = $request->input('type');
        $productId = $request->input('id');
        if ((!empty($productType) && $productType == 'course') && !empty($productId)) {
            $productDescription = Course::find($productId);
        } else {
            abort(404);
        }
        if (!empty($productDescription)) {
            $productDescription['productType'] = $productType;
        } else {
            abort(404);
        }
        $user = \Auth::user();
        $data = [
            "product_description" => !empty($productDescription) ? $productDescription : [],
            "user" => !empty($user) && is_object($user) ? $user->toArray() : []
        ];
        // dd($data, $user);
        return view('orders.add_to_cart', $data);
    }

    public function edit(Request $request, $id)
    {
        if (!User::hasPermissions(["Edit Order"])) {
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $order = Order::find($id);
        $order = is_object($order) ? $order->toArray() : $order;
        $data = [
            'orders' => $order,
            'page_group' => 'module'
        ];
        // dd($order);
        return view('cms.orders.edit',$data);
    }
    public function update(Request $request)
    {
        if (!User::hasPermissions(["Edit Order"])) {
            return redirect()->back()->with('error', 'Permission Denied');
        }
        $id = $request->input("id", '');
        $paymentObject = [
            'discount' => !empty($request->input('discount')) ? $request->input('discount') : '',
            'coupon' => !empty($request->input('coupon')) ? $request->input('coupon') : '',
            'amount' => !empty($request->input('amount')) ? $request->input('amount') : '',
            'status' => !empty($request->input('status')) ? $request->input('status') : 'proceed'
        ];

        $order = Order::find($id);
        if (!empty($order->payment_details)) {
            $index = count($order->payment_details);
            $payment_details = $order->payment_details;
            $payment_details[$index] = $paymentObject;
            $order->payment_details = $payment_details;
        } else {
            $payment_details[0] = $paymentObject;
            $order->payment_details = $payment_details;
        }
        $order->discount = !empty($request->input('discount')) ? $request->input('discount') : '';
        $order->coupon = !empty($request->input('coupon')) ? $request->input('coupon') : '';
        $order->amount = !empty($request->input('amount')) ? $request->input('amount') : '';
        $order->status = !empty($request->input('status')) ? $request->input('status') : 'proceed';
        $order->save();
        // dd($request->all(), $order->toArray());

        return redirect()->back()->with('success', 'Order updated successfully');
    }


    public function applyCoupon(Request $request, $coupon, $orderId = '')
    {
        $coupon = Coupon::getCouponByCode($coupon);
        $orderId =  !empty($request->input('orderId')) ? $request->input('orderId') : '';
        $order = Order::find($orderId);
        $product_id = !empty($order['product_id']) ? $order['product_id'] : '';
        $course = Course::find($product_id);
        if (empty($course)) {
            return "Product Not Listed";
        }
        $orderAmout = !empty($order) && !empty($order['amount']) ? $order['amount'] : '';
        $couponValue = '';
        $status = 'Validating Coupon';
        $courseSlug = !empty($course['slug']) ? $course['slug'] : '';
        // $courseSlug = 'digital-marketing-certification-program';
        if (!empty($coupon['status']) && $coupon['status'] == 'disable') {
            return 'Invalid Coupon Code';
        }
        if (!empty($coupon['courses']) && !in_array($courseSlug, $coupon['courses'])) {
            return 'This coupon is not valid for this course!';
        }
        if (!empty($coupon['min_cart_value']) && $coupon['min_cart_value'] > $orderAmout) {
            return 'Add more item in cart to avail discount';
        }
        $couponValue = !empty($coupon['coupon_value']) ? $coupon['coupon_value'] : 0;
        $maxDiscount = !empty($coupon['max_discount']) ? $coupon['max_discount'] : '';
        if (!empty($coupon['unit']) && $coupon['unit'] == "percent") {
            $couponValue =  $orderAmout * $couponValue / 100;
        }
        if (!empty($couponValue) && $couponValue > $maxDiscount) {
            $couponValue = $maxDiscount;
        }

        if ((!empty($coupon['type']) && $coupon['type'] == 'discount')) {
            $amoutnWithCoupon =  $orderAmout - $couponValue;
            if ($amoutnWithCoupon < 0) {
                $amoutnWithCoupon = 0;
            }
            $status = 'Applied';
            $msg = 'You Saved Rs-' . $couponValue . ' with this order.';
            $data = [
                "status" => $status,
                "discount_value" => !empty($couponValue) ? $couponValue : 0,
                "order_amount" => !empty($amoutnWithCoupon) && $amoutnWithCoupon < $orderAmout || $amoutnWithCoupon == 0 ? $amoutnWithCoupon : $orderAmout,
                "display_msg" => !empty($msg) ? $msg : ''
            ];
            if (!empty($order)) {
                $order->coupon_status = $status;
                $order->discount = !empty($couponValue) ? $couponValue : 0;
                $order->coupon = !empty($coupon['code']) ? $coupon['code'] : '';
                if ((!empty($amoutnWithCoupon) && $amoutnWithCoupon < $orderAmout) || $amoutnWithCoupon == 0) {
                    $order->amount =  $amoutnWithCoupon;
                }
                $order->save();
            } else {
                return 'You have not created any order yet. Please create an order first.';
            }
            return $data;
        } elseif ((!empty($coupon['type']) && $coupon['type'] == 'cashback')) {
            $amoutWithCoupon =  $orderAmout;
            $status = 'Cashback Added';
            $msg = 'Cashback Added of Rs-' . $couponValue . ' with this order.';
            $data = [
                "status" => $status,
                "order_amount" => !empty($amoutWithCoupon) ? $amoutWithCoupon : $orderAmout,
                'cashback_amount' => !empty($couponValue) ? $couponValue : '',
                "display_msg" => !empty($msg) ? $msg : ''
            ];
            if (!empty($order)) {
                $order->coupon_status = $status;
                $order->cashback = !empty($couponValue) ? $couponValue : 0;
                $order->coupon = !empty($coupon['code']) ? $coupon['code'] : '';
                $order->amount =  !empty($amoutWithCoupon) ? $amoutWithCoupon : $orderAmout;
                $order->save();
            } else {

                return 'You have not created any order yet. Please create an order first.';
            }
            return $data;
        }
        return 'something went wrong';
    }

    public function paymentProcess(Request $request)
    {
        $orderId =  !empty($request->input('orderId')) ? $request->input('orderId') : '';
        //dd($orderId,$request);
        if (empty($orderId)) {
            abort(404);
        }
        $order = Order::find($orderId);
        $userId = !empty($order['user_id']) ? $order['user_id'] : '';
        $userDetails = User::find($userId);
        $cartAmount = !empty($order['amount']) || $order['amount'] == 0 ? $order['amount'] : '';
        //dd($cartAmount);
        if ((!empty($cartAmount) && $cartAmount == 0) || $cartAmount == 0) {
            $order->payment_details = [
                "amount" => 0,
                "payment_mode" => "AB_WALLET",
                "status" => "SUCCESS",
                "date" => date("Y/m/d"),
                "time" => date("h:i:sa")
            ];
            $order->status = "PAID";
            $order->save();

            $duration = strtotime("+3 Months");
            $today = strtotime("today");
            $subscription = new Subscription;
            $subscription->product_id = !empty($order['product_id']) ? $order['product_id'] : '';
            $subscription->product_type = !empty($order['product_type']) ? $order['product_type'] : '';
            $subscription->product_name = !empty($order['product_name']) ? $order['product_name'] : '';
            $subscription->uid = !empty($order['uid']) ? $order['uid'] : '';
            $subscription->user_id = !empty($order['user_id']) ? $order['user_id'] : '';
            $subscription->user_name = !empty($userDetails) && !empty($userDetails['name']) ? $userDetails['name'] : '';
            $subscription->start_date = date("Y-m-d h:i:sa", $today);
            $subscription->expiry_date = date("Y-m-d h:i:sa", $duration);
            $subscription->save();

            $uid = !empty($order['uid']) ? $order['uid'] : '';
            $subscriptionDetails = Subscription::getSubscriptionByUID($uid);

            $data = [
                "subscription" => !empty($subscriptionDetails) ? $subscriptionDetails : [],
                "order_details" => !empty($order) ? $order : []
            ];

            return view('orders.success', $data);
        } else {
            return $this->makePayment($request, $orderId);
        }
    }

    public function makePayment(Request $request, $orderId = '')
    {
        $order = Order::find($orderId);
        $cartAmount = !empty($order) && !empty($order['amount']) ? $order['amount'] : '';
        $paymentMethod = !empty($request->input('payment_method')) ? $request->input('payment_method') : 'RazorPay';
        // dd($order,$cartAmount,$paymentMethod);
        if (empty($cartAmount) || empty($paymentMethod)) {
            abort(404);
        }

        $transactionDetails = [];
        $transactionDetails['statue'] = 'failed';
        $paymentStatus = !empty($transactionDetails['status']) ? $transactionDetails['status'] : 'failed';
        $paidAmount = !empty($transactionDetails['amount']) ? $transactionDetails['amount'] : 0;

        $data = [
            "order_details" => !empty($order) ? $order : [],
            "transaction" => !empty($transactionDetails) ? $transactionDetails : []
        ];

        // dd($paymentStatus,$cartAmount,$paidAmount);
        if ($paymentStatus == 'undefined' || $paymentStatus == 'failed' || $paymentStatus == '' || $paymentStatus == null) {
            return view('orders.failed', $data);
        } elseif ($paymentStatus == 'success' && $cartAmount != $paidAmount) {
            return view('orders.failed', $data);
        } elseif ($paymentStatus == 'success' && $cartAmount == $paidAmount) {
            $order->payment_details = [
                "amount" => !empty($paidAmount) ? $paidAmount : '',
                "payment_mode" => !empty($paymentMethod) ? $paymentMethod : '',
                "status" => "SUCCESS",
                "date" => date("Y/m/d"),
                "time" => date("h:i:sa")
            ];
            $order->status = "PAID";
            $order->save();

            $duration = strtotime("+3 Months");
            $today = strtotime("today");
            $subscription = new Subscription;
            $subscription->product_id = !empty($order['product_id']) ? $order['product_id'] : '';
            $subscription->product_type = !empty($order['product_type']) ? $order['product_type'] : '';
            $subscription->product_name = !empty($order['product_name']) ? $order['product_name'] : '';
            $subscription->uid = !empty($order['uid']) ? $order['uid'] : '';
            $subscription->user_id = !empty($order['user_id']) ? $order['user_id'] : '';
            $subscription->user_name = !empty($userDetails) && !empty($userDetails['name']) ? $userDetails['name'] : '';
            $subscription->start_date = date("Y-m-d h:i:sa", $today);
            $subscription->expiry_date = date("Y-m-d h:i:sa", $duration);
            $subscription->save();

            $uid = !empty($order['uid']) ? $order['uid'] : '';
            $subscriptionDetails = Subscription::getSubscriptionByUID($uid);

            $data = [
                "subscription" => !empty($subscriptionDetails) ? $subscriptionDetails : [],
                "order" => !empty($order) ? $order : []
            ];

            return view('orders.success', $data);
        }
    }

    public function success(Request $request, $orderId = '', $status = '')
    {
        $orderId = $request ->input("orderId");
        $payment_status = $request->input("status");
        $order = Order::find($orderId);

        $duration = strtotime("+3 Months");
        $today = strtotime("today");
        $subscription = new Subscription;
        $subscription->product_id = !empty($order['product_id']) ? $order['product_id'] : '';
        $subscription->product_type = !empty($order['product_type']) ? $order['product_type'] : '';
        $subscription->product_name = !empty($order['product_name']) ? $order['product_name'] : '';
        $subscription->uid = !empty($order['uid']) ? $order['uid'] : '';
        $subscription->user_id = !empty($order['user_id']) ? $order['user_id'] : '';
        $subscription->user_name = !empty($userDetails) && !empty($userDetails['name']) ? $userDetails['name'] : '';
        $subscription->start_date = date("Y-m-d h:i:sa", $today);
        $subscription->expiry_date = date("Y-m-d h:i:sa", $duration);
        $subscription->save();

        $uid = !empty($order['uid']) ? $order['uid'] : '';
        $subscriptionDetails = Subscription::getSubscriptionByUID($uid);

        $data = [
            "subscription" => !empty($subscriptionDetails) ? $subscriptionDetails : [],
            "order_details" => !empty($order) ? $order : []
        ];

        return view('orders.success', $data);
        
    }

    public function fail(Request $request)
    {
      //  dd($request->all());
        $data = [
            "order_details" => !empty($order) ? $order : [],
            "status" => !empty($request->input('status')) ? $request->input('status') : ''
        ];
        return view('orders.failed', $data);
    }
}
