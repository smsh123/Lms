@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Edit Coupon</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/coupons" class="btn btn-lg btn-secondary">View Coupons</a></div>
  </div>

  <form class="card" method="post" action="/cms/coupons/update">
    @csrf
    <input type="hidden" value="{{ !empty($coupons['id']) ? $coupons['id'] : '' }}" name="id" />
    <div class="card-body">
       <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Courses</label>
          <select class="form-control" name="courses">
            <option value="all">All Courses</option>
            @if(!empty($courses))
              @foreach ($courses as $course)
                  <option @if(!empty($coupons['courses']) && $coupons['courses'] == $course['slug']) selected @endif value="{{ !empty($course['slug']) ? $course['slug'] : ''}}">{{ !empty($course['name']) ? $course['name'] : ''}}</option>
              @endforeach
            @endif
          </select>
          @if ($errors->has('courses'))
            <p class="text-danger">{{ $errors->first('courses') }}</p>
          @endif
        </div>
        <div class="col-lg-6">
          <label class="font-weight-bold">Coupon Code</label>
          <input type="text" class="form-control text-uppercase" placeholder="code" name="code" value="{{ !empty($coupons['code']) ? $coupons['code'] : ''}}" />
          @if ($errors->has('code'))
            <p class="text-danger">{{ $errors->first('code') }}</p>
          @endif
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Start Date</label>
          <input type="date" class="form-control" name="start_date" placeholder="Start Date" value="{{ !empty($coupons['start_date']) ? $coupons['start_date'] : ''}}" />
        </div>
         <div class="col-lg-6">
            <label class="font-weight-bold">End Date</label>
            <input type="date" class="form-control" name="end_date" placeholder="End Date" value="{{ !empty($coupons['end_date']) ? $coupons['end_date'] : ''}}"  />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Coupon Type</label>
          <select class="form-control" name="type">
            <option {{ !empty($coupons['type']) && $coupons['type'] == 'discount' ? 'selected' : ''}} value="discount">Discount</option>
            <option  {{ !empty($coupons['type']) && $coupons['type'] == 'cashback' ? 'selected' : ''}} value="cashback">Cashback</option>
            <option {{ !empty($coupons['type']) && $coupons['type'] == 'coupon' ? 'selected' : ''}} value="coupon">Coupon</option>
          </select>
          @if ($errors->has('type'))
            <p class="text-danger">{{ $errors->first('type') }}</p>
          @endif
        </div>
        <div class="col-lg-6 align-self-center">
            <label class="font-weight-bold mb-0">Coupon Unit</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="unit" id="inlineRadio1" value="flat" {{ !empty($coupons['unit']) && $coupons['unit'] == 'flat' ? 'checked' : ''}}>
              <label class="form-check-label mb-0" for="inlineRadio1">Flat</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="unit" id="inlineRadio2" value="percentage" {{ !empty($coupons['unit']) && $coupons['unit'] == 'percentage' ? 'checked' : ''}}>
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
          <input type="number" class="form-control" name="coupon_value" placeholder="Amount" value="{{ !empty($coupons['coupon_value']) ? $coupons['coupon_value'] : ''}}"  />
          @if ($errors->has('coupon_value'))
              <p class="text-danger">{{ $errors->first('coupon_value') }}</p>
          @endif
        </div>
        <div class="col-lg-6">
            <label class="font-weight-bold">Max Discount</label>
            <input type="number" class="form-control" name="max_discount" placeholder="Max Amount" value="{{ !empty($coupons['max_discount']) ? $coupons['max_discount'] : ''}}" />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-6">
          <label class="font-weight-bold">Minimum Purchase Value</label>
          <input type="number" class="form-control" name="min_cart_value" placeholder="Min Cart Value" value="{{ !empty($coupons['min_cart_value']) ? $coupons['min_cart_value'] : ''}}" />
        </div>
        <div class="col-lg-6">
            <label class="font-weight-bold">Coupon Limit</label>
            <input type="number" class="form-control" name="coupon_limit" placeholder="Max Redeem Time"  value="{{ !empty($coupons['coupon_limit']) ? $coupons['coupon_limit'] : ''}}" />
        </div>
      </div>
      <div class="row form-group">
        <div class="col-lg-12">
          <label class="font-weight-bold">Status</label>
          <select class="form-control" name="status">
            <option {{ !empty($coupons['status']) && $coupons['status'] == 'enable' ? 'selected' : '' }} value="enable">Enable</option>
            <option value="disable" {{ !empty($coupons['status']) && $coupons['status'] == 'disable' ? 'selected' : '' }}>Disable</option>
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