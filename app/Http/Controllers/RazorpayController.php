<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function initiatePayment(Request $request)
    {
        try {
            $amount = $request->input("amount", 100);
            $razor_order_id = $this->createOrder($amount);
            $apiKey = config('services.razorpay.key');
            $attributes = [
                'IMAGE' => "",
                'USER_NAME' => "Arya",
                'USER_CONTACT' => "7000621203",
                'USER_EMAIL' => "someshk7000@gmail.com",
                'CALLBACK_URL' => env("RAZORPAY_SUCCESS_URL"),
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
    public function createOrder($amount = 1)
    {
        // $apiKey = config('services.razorpay.key');
        // $apiSecret = config('services.razorpay.secret');
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'amount' => $amount * 100, // Razorpay uses paisa, so convert to paise
            'currency' => 'INR',
            'receipt' => 'order_' . time(),
        ]);
        // dd($order->id);
        return !empty($order->id) ? $order->id : "";
    }

    public function paymentCallback(Request $request)
    {
        dd($request->all());
        // Handle the Razorpay payment callback here
    }
}
