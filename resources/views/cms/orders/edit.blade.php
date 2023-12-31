@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Edit Order</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/orders" class="btn btn-lg btn-secondary">View Orders</a></div>
  </div>
  <form class="card" method="post" action="/cms/orders/update">
    @csrf
    <input type="hidden" name="id" value="{{ !empty($orders['_id']) ? $orders['_id'] : '' }}" />
    <div class="card-body mb-3">
      <div class="row">
        <div class="col-6">
          <lable class="font-weight-bold">UID</lable>
          <p>{{ !empty($orders['uid']) ? $orders['uid'] :  '' }}</p>
        </div>
        <div class="col-6">
          <lable class="font-weight-bold">Order Date</lable>
          <p>{{ !empty($orders['created_at']) ? (new DateTime($orders['created_at']))->format('d/m/Y')  :  '' }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <lable class="font-weight-bold">Name</lable>
          <p>{{ !empty($orders['user_details']['full_name']) ? $orders['user_details']['full_name'] :  '' }}</p>
        </div>
        <div class="col-6">
          <lable class="font-weight-bold">Mobile</lable>
          <p>{{ !empty($orders['user_details']['mobile']) ? $orders['user_details']['mobile'] :  '' }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <lable class="font-weight-bold">Email</lable>
          <p>{{ !empty($orders['user_details']['email']) ? $orders['user_details']['email'] :  '' }}</p>
        </div>
        <div class="col-6">
          <lable class="font-weight-bold">State</lable>
          <p>{{ !empty($orders['user_details']['state']) ? $orders['user_details']['state'] :  '' }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <lable class="font-weight-bold">Product Type</lable>
          <p>{{ !empty($orders['product_type']) ? $orders['product_type'] :  '' }}</p>
        </div>
        <div class="col-6">
          <lable class="font-weight-bold">Product</lable>
          <p>{{ !empty($orders['product_name']) ? $orders['product_name'] :  '' }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <lable class="font-weight-bold">Product Price</lable>
          <p>{{ !empty($orders['price']) ? $orders['price'] :  0 }}</p>
        </div>
        <div class="col-6">
          <lable class="font-weight-bold">Discount</lable>
          <p>{{ !empty($orders['discount']) ? $orders['discount'] :  0 }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <lable class="font-weight-bold">Coupon</lable>
          <p>{{ !empty($orders['coupon']) ? $orders['coupon'] :  'XXNOXX' }}</p>
        </div>
        <div class="col-6">
          <lable class="font-weight-bold">Total</lable>
          <p>{{ !empty($orders['amount']) ? $orders['amount'] :  0 }}</p>
        </div>
      </div>
    </div>
    <div class="card-body">
      <h3 class="font-22 font-weight-bold">Add Payment</h3>
      <div class="row">
        <div class="col-md-6">
          <label class="font-weight-bold mt-3">Payment Type</label>
          <select class="form-control" name="payment_type">
            <option value="full_payment">Full Payment</option>
            <option value="part_payment">Part Payment</option>
            <option value="due_payment">Due Payment</option>
            <option value="pu_payment">Plan Upgradation Payment</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="font-weight-bold mt-3">Payment Mode</label>
          <select class="form-control" name="payment_mode">
            <option value="nb">Netbanking</option>
            <option value="cc">Credit Card</option>
            <option value="dc">Debit Card</option>
            <option value="dw">Digital Wallet</option>
            <option value="sqr">Scan QR</option>
            <option value="upi">Unified Payment Interface (UPI)</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label class="font-weight-bold mt-3">Transaction ID</label>
          <input type="text" class="form-control" name="transaction_id" />
        </div>
        <div class="col-md-6">
          <label class="font-weight-bold mt-3">Payment Amount</label>
          <input type="text" class="form-control" name="amount" />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12 col-lg-6">
          <label class="font-weight-bold mt-3">Screenshot Image</label>
          <div class="input-group upload-image mb-3">
            <input id="inputImage" type="file" class="form-control" placeholder="Banner Image">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" onclick="CustomFunctions.uploadImage('inputImage','form-image-input','image-preview');" type="button" id="button-addon2">Upload</button>
            </div>
          </div>
          <input id="form-image-input" type="hidden" class="form-control" name="screenshot_image" />

          <div class="w-100 mw-320">
            <div class="ratio-image image_16-9">
              <img id="image-preview" src="" />
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center">
          <input type="submit" class="btn btn-primary" value="Add Payment" />
        </div>
      </div>
    </div>
  </form>

@stop