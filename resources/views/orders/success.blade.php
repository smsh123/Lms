@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container-bottom position-relative py-3">
   {{-- @if(!empty($saved_order))
    @php dd($saved_order); @endphp
   @endif --}}
    <div class="container">
      @if((!empty($order_details) && !empty($transaction)) || (!empty($order_details) && !empty($subscription)))
        <div class="card border-success mb-4 mw-768 mx-auto">
          <div class="card-body text-center">
            <h1 class="font-32 font-weight-bold text-success">Congratulations!</h1>
            <p class="font-32 text-success"><i class="bi bi-emoji-smile"></i></p>
            <p>Your order has been successfully placed. Enjoy learning</p>
          </div>
          <div class="card-footer text-center">
            <p>A welcome call will be arranged for this order. Incase you have any other query for this order feel free to get in touch with our support team.</p>
            @if(!empty($order_details['uid']))
              <div class="alert alert-success my-3 font-weight-bold">{{ "Your order id is- ".$order_details['uid'] }}</div>
            @endif
            <p>Our support executive may ask your transaction details align with your personal details to verify your order and transaction details. Never share card number,OTP ,CVV, Password etc</p>
          </div>
        </div>
        <div class="py-3 text-center">
          <p class="font-weight-bold">Customer Support Details</p>
          <p class="font-22">Call Us</p>
          <p class="font-weight-bold font-32">9319818659</p>
          <p class="font-22">Chat with Us</p>Don't worry you can get in touch with our support team in case your money has been debited or you want to process this order via offline payments.
          <p class="font-weight-bold font-32">9319818659</p>
          <p class="font-22">Write Us</p>
          <p class="font-weight-bold font-22">support@aryabhattclasses.com</p>
        </div>
      @else
        <div class="alert alert-danger text-center my-5 text-center font-weight-bold">
          Oops! something went wrong with this transaction.
        </div>
      @endif
    </div>
  </div>
  
@stop

