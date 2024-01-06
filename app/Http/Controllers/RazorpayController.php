<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Order;
use Log;

class RazorpayController extends Controller
{
    public function initiatePayment(Request $request)
    {
        $orderId =  !empty($request->input('orderId')) ? $request->input('orderId') : '';
        //dd($orderId,$request);
        if (empty($orderId)) {
            abort(404);
        }
        $_order = Order::find($orderId);
        $order = is_object($_order) ? $_order->toArray() : $_order;
        $cartAmount = !empty($order['amount']) || $order['amount'] == 0 ? $order['amount'] : '';
        $razor_order_id = $this->createOrder($cartAmount, $orderId);
        $_order->payment_provider = "razor_pay";
        $_order->payment_provider_order_id = $razor_order_id;
        $_order->save();
        try {
            $apiKey = config('services.razorpay.key');
            $attributes = [
                'IMAGE' => "",
                'USER_NAME' => $order['user_details']['full_name'] ?? "",
                'USER_CONTACT' => $order['user_details']['mobile'] ?? "",
                'USER_EMAIL' => $order['user_details']['email'] ?? "",
                'CALLBACK_URL' => env('RAZORPAY_CALLBACK_URL'),
                'CANCEL_URL' => env("RAZORPAY_FAIL_URL"),
                'RAZORPAY_KEY_ID' => $apiKey,
                'ORDER_ID' => $razor_order_id,
                'NAME' => 'AryaBhat Classess',
                'DESCRIPTION' => 'ArybaBhat'

            ];
            return view('razorpay.initiate_transaction')->with($attributes);
        } catch (\Exception $e) {
            return $this->respondWithError('Unable to find transaction', 400);
        }
    }
    public function createOrder($amount = 1, $order_id = null)
    {
        // $apiKey = config('services.razorpay.key');
        // $apiSecret = config('services.razorpay.secret');
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'amount' => $amount * 100, // Razorpay uses paisa, so convert to paise
            'currency' => 'INR',
            'receipt' => !empty($order_id) ? $order_id : 'order_' . time(),
        ]);
        // dd($order->id);
        return !empty($order->id) ? $order->id : "";
    }

    public function paymentCallback(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        Log::info("status details", [json_encode($data)]);
        $order = [];
        if (isset($data['error'])) {
            $meta = isset($data['error']['metadata']) ?  $data['error']['metadata'] : [];
            $metadata = json_decode($meta, true);
            $razorpay_order_id   = isset($metadata['order_id']) ? $metadata['order_id'] : '';
            $razorpay_payment_id = isset($metadata['payment_id']) ? $metadata['payment_id'] : '';
            $status = "FAILED";
            return redirect('/order/fail?&status=' . $status);
        } else {
            $razorpay_signature  = $data['razorpay_signature'];
            $razorpay_order_id   = $data['razorpay_order_id'];
            $razorpay_payment_id = $data['razorpay_payment_id'];
            $status = "SUCCESS";
            $order = Order::where("payment_provider_order_id", $razorpay_order_id)->firstorFail();
            $order->transaction = $data;
            $order->payment_mode = "online";
            $order->payment_status = $status;
            $order->save();

            return redirect('/order/success?orderId=' . $order->_id . "&status=" . $status);
        }
        // dd($data, $order ?? "");
        // Handle the Razorpay payment callback here
    }
}
