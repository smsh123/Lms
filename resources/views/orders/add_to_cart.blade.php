@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container-bottom position-relative py-3">
   {{-- @if(!empty($saved_order))
    @php dd($saved_order); @endphp
   @endif --}}
    <div class="container">
      @if(!empty($product_description))
        <div class="row">
          <div class="col-lg-8">
            <form class="card">
              @csrf
              <div class="card-header font-weight-bold">Basic Details</div>
              <input id="referrer" type="hidden" name="referrer" value="{{ !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : ''}}" />
              <div id="cart_step_1" class="card-body row">
                <div class="form-group col-12">
                  <label class="forn-weight-bold">Full Name</label>
                  <input id="user_full_name" type="text" name="user_full_name" class="form-control" value="{{@$user['name']}}" />
                </div>
                <div class="form-group col-12 col-lg-6">
                  <label class="forn-weight-bold">Mobile</label>
                  <input id="user_mobile" type="number" name="user_mobile" class="form-control" value="{{@$user['mobile']}}" />
                </div>
                <div class="form-group col-12 col-lg-6">
                  <label class="forn-weight-bold">Email</label>
                  <input id="user_email" type="email" name="user_email" class="form-control" value="{{@$user['email']}}" />
                </div>
                <div class="form-group col-12 col-lg-6">
                  <label class="forn-weight-bold">State</label>
                  <input id="state" type="text" name="state" class="form-control" value="{{@$user['state']}}" />
                </div>
                <div class="form-group col-12 col-lg-6">
                  <label class="forn-weight-bold">City</label>
                  <input id="city" type="text" name="city" class="form-control"  value="{{@$user['city']}}"/>
                </div>
                <div class="form-group col-12">
                  <input id="product_type" type="hidden" name="product_type" value="{{ !empty($product_description['productType']) ? $product_description['productType'] : ''}}" />
                  <input id="product_name" type="hidden" name="product_name" value="{{ !empty($product_description['name']) ? $product_description['name'] : ''}}" />
                  <input id="product_id" type="hidden" name="product_id" value="{{ !empty($product_description['_id']) ? $product_description['_id'] : ''}}" />
                  <input id="price" type="hidden" name="price" value="{{ !empty($product_description['selling_price']) ? $product_description['selling_price'] : '' }}" />
                  <input id="course_slug" type="hidden" name="course_slug" value="{{ !empty($product_description['slug']) ? $product_description['slug'] : '' }}" />
                  <input type="hidden" name="discount" />
                  <input id="amount" type="hidden" name="amount" value="{{ !empty($product_description['selling_price']) ? $product_description['selling_price'] : '' }}" />
                  <input type="hidden" name="coupon" />
                  <input id="status" type="hidden" name="status" value="created" />
                </div>
                <div class="form-group col-12 text-center">
                  <input type="button" class="btn btn-lg btn-theme-contrast rounded-pill" value="Proceed" onclick="CustomFunctions.addToCart()"  />
                </div>
              </div>
            </form>
            <div class="card">
              <div class="card-header font-weight-bold">Offer & Discount</div>
              <form id="cart_step_2"  method="post" action="/apply-coupon/" class="card-body text-center" style="display:none;">
                <label class="font-weight-bold">Have Your Coupon Code?</label>
                <div class="input-group mb-3 mw-320 mx-auto">
                  <input id="coupon_input" type="text" class="form-control" placeholder="Coupon Code">
                  <div class="input-group-append">
                    <button id="coupon_btn" class="btn btn-success" type="button" id="button-addon2" onclick="CustomFunctions.applyCoupon()"">Apply</button>
                  </div>
                </div>
                <p id="coupon_msg"></p>
              </form>
              <input type="hidden" id="saved_order_id" />
            </div>
            <div class="text-center py-3">
              <form method="post" action="/razorpay/initiate-payment">
                @csrf
                <input type="hidden" name="payment_method" />
                <input type="hidden" name="orderId" />
                <input type="submit" class="btn btn-lg btn-theme-contrast font-22 font-weight-bold btn_checkout" style="display:none;" value="Proceed to Checkout">              </form>
              </form>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-header font-weight-bold text-center">Product Details</div>
              <div class="card-body text-center">
                <p class="font-22">{{ !empty($product_description['name']) ? $product_description['name'] : '' }}</p>
                <p class="font-22">{{ !empty($product_description['selling_price']) ? '₹'.$product_description['selling_price'].'/-' : '' }}</p>
              </div>
              <div class="card-footer text-center">
                <p class="mb-2">Total Payable Amount</p>
                <p class="font-32 font-weight-bold text-primary">{{ !empty($product_description['selling_price']) ? '₹'.$product_description['selling_price'].'/-' : '' }}</p>
                <p class="font-12 text-muted">*inclusive all texes.</p>
              </div>
            </div>
            <div class="text-center py-3">
              <form method="post" action="/razorpay/initiate-payment">
                @csrf
                <input type="hidden" name="payment_method" />
                <input type="hidden" name="orderId" />
                <input type="submit" class="btn btn-lg btn-theme-contrast font-22 font-weight-bold btn_checkout" style="display:none;" value="Proceed to Checkout">              </form>
              </form>
            </div>
          </div>
        </div>
      @else
        <div class="alert alert-danger text-center my-5 text-center font-weight-bold">
          Oops! something went wrong with selected product.
        </div>
      @endif
    </div>
  </div>
  
@stop

