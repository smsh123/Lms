@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container-bottom position-relative py-3">
    <div class="container">
      @if(!empty($transaction) && !empty($order_details))
        <div class="card border-danger mb-4 mw-768 mx-auto">
          <div class="card-body text-center">
            <h1 class="font-32 font-weight-bold text-danger">Order Failed!</h1>
            <p class="font-32 text-danger"><i class="bi bi-emoji-frown"></i></p>
            <p>Oops! something went wrong with this transaction.</p>
          </div>
          <div class="card-footer text-center">
            <p>Don't worry you can get in touch with our support team in case your money has been debited or you want to process this order via offline payments.</p>
            @if(!empty($order_details['uid']))
              <div class="alert alert-warning my-3 font-weight-bold">{{ "Your order id is- ".$order_details['uid'] }}</div>
            @endif
            <p>Our support executive may ask your transaction details align with your personal details to verify your order and transaction details. Never share card number,OTP ,CVV, Password etc</p>
          </div>
        </div>
        <div class="py-3 text-center">
          <p class="font-weight-bold">Customer Support Details</p>
          <p class="font-22">Call Us</p>
          <p class="font-weight-bold font-32">1800 00 1111</p>
          <p class="font-22">Chat with Us</p>
          <p class="font-weight-bold font-32">8090 11 2020</p>
          <p class="font-22">Write Us</p>
          <p class="font-weight-bold font-22">support@aryabhattclasses.com</p>
        </div>
      @else
        <div class="alert alert-danger text-center my-5 text-center font-weight-bold">
          Oops! something went wrong with this transaction/order.
        </div>
      @endif
    </div>
  </div>
  
@stop

