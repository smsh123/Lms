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
          <div class="col-8">
            <form class="card" method="post" action="/orders/store">
              @csrf
              <input type="hidden" name="referrer" value="{{ !empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : ''}}" />
              <div class="card-body row">
                <div class="form-group col-12">
                  <label class="forn-weight-bold">Full Name</label>
                  <input type="text" name="user_full_name" class="form-control" />
                </div>
                <div class="form-group col-12 col-lg-6">
                  <label class="forn-weight-bold">Mobile</label>
                  <input type="number" name="user_mobile" class="form-control" />
                </div>
                <div class="form-group col-12 col-lg-6">
                  <label class="forn-weight-bold">Email</label>
                  <input type="email" name="user_email" class="form-control" />
                </div>
                <div class="form-group col-12 col-lg-6">
                  <label class="forn-weight-bold">State</label>
                  <input type="text" name="state" class="form-control" />
                </div>
                <div class="form-group col-12 col-lg-6">
                  <label class="forn-weight-bold">City</label>
                  <input type="text" name="city" class="form-control" />
                </div>
                <div class="form-group col-12">
                  <input type="hidden" name="product_type" value="{{ !empty($product_description['productType']) ? $product_description['productType'] : ''}}" />
                  <input type="hidden" name="product_name" value="{{ !empty($product_description['name']) ? $product_description['name'] : ''}}" />
                  <input type="hidden" name="product_id" value="{{ !empty($product_description['_id']) ? $product_description['_id'] : ''}}" />
                  <input type="hidden" name="price" value="{{ !empty($product_description['selling_price']) ? $product_description['selling_price'] : '' }}" />
                  <input type="hidden" name="discount" />
                  <input type="hidden" name="amount" value="{{ !empty($product_description['selling_price']) ? $product_description['selling_price'] : '' }}" />
                  <input type="hidden" name="coupon" />
                  <input type="hidden" name="status" value="created" />
                </div>
                <div class="form-group col-12 text-center">
                  <input type="submit" class="btn btn-lg btn-theme-contrast rounded-pill" value="Proceed"  />
                </div>
              </div>
            </form>
            <div class="card">
              <div class="card-body text-center">
                <label class="font-weight-bold">Have Your Coupon Code?</label>
                <div class="input-group mb-3 mw-320 mx-auto">
                  <input type="text" class="form-control" placeholder="Coupon Code">
                  <div class="input-group-append">
                    <button class="btn btn-success" type="button" id="button-addon2">Apply</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4">
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
              <div class="text-center py-3">
                <a href="" class="btn btn-lg btn-theme-contrast font-22 font-weight-bold">Proceed to Checkout</a>
              </div>
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

