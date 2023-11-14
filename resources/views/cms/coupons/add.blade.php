@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Add Coupon</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/coupons" class="btn btn-lg btn-secondary">View Coupons</a></div>
  </div>


  <form class="card" method="post" action="/cms/coupons/store">
    @csrf
    <div class="card-body">
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Courses</label>
          <select class="form-control" name="courses">
            <option value="all">All Courses</option>
            @if(!empty($courses))
              @foreach ($courses as $course)
                  <option value="{{ !empty($course['slug']) ? $course['slug'] : ''}}">{{ !empty($course['name']) ? $course['name'] : ''}}</option>
              @endforeach
            @endif
          </select>
          @if ($errors->has('courses'))
            <p class="text-danger">{{ $errors->first('courses') }}</p>
          @endif
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Coupon Code</label>
          <input type="text" class="form-control text-uppercase" placeholder="code" name="code" />
          @if ($errors->has('code'))
            <p class="text-danger">{{ $errors->first('code') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Start Date</label>
          <input type="date" class="form-control" name="start_date" placeholder="Start Date" />
        </div>
         <div class="col-lg-6">
            <label class="font-weight-bold">End Date</label>
            <input type="date" class="form-control" name="end_date" placeholder="End Date" />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Coupon Type</label>
          <select class="form-control" name="type">
            <option value="discount">Discount</option>
            <option value="cashback">Cashback</option>
            <option value="coupon">Coupon</option>
          </select>
          @if ($errors->has('type'))
            <p class="text-danger">{{ $errors->first('type') }}</p>
          @endif
        </div>
        <div class="col-lg-6 align-self-center">
            <label class="font-weight-bold mb-0">Coupon Unit</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="unit" id="inlineRadio1" value="flat">
              <label class="form-check-label mb-0" for="inlineRadio1">Flat</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="unit" id="inlineRadio2" value="percentage">
              <label class="form-check-label mb-0" for="inlineRadio2">Percentage</label>
            </div>
            @if ($errors->has('unit'))
              <p class="text-danger">{{ $errors->first('unit') }}</p>
            @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Coupon Value</label>
          <input type="number" class="form-control" name="coupon_value" placeholder="Amount" />
          @if ($errors->has('coupon_value'))
              <p class="text-danger">{{ $errors->first('coupon_value') }}</p>
          @endif
        </div>
        <div class="col-lg-6">
            <label class="font-weight-bold">Max Discount</label>
            <input type="number" class="form-control" name="max_discount" placeholder="Max Amount" />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Minimum Purchase Value</label>
          <input type="number" class="form-control" name="min_cart_value" placeholder="Min Cart Value" />
        </div>
        <div class="col-lg-6">
            <label class="font-weight-bold">Coupon Limit</label>
            <input type="number" class="form-control" name="coupon_limit" placeholder="Max Redeem Time" />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Status</label>
          <select class="form-control" name="status">
            <option value="enable">Enable</option>
            <option value="disable">Disable</option>
          </select>
          @if ($errors->has('status'))
            <p class="text-danger">{{ $errors->first('status') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-12 text-center">
          <input type="submit" class="btn btn-lg btn-primary" value="Submit" />
        </div>
      </div>
    </div>
  </form>

@stop