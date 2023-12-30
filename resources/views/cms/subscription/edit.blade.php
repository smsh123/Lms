@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1>Edit Subscription</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/subscriptions" class="btn btn-lg btn-secondary">View Subscriptions</a></div>
  </div>
  <form class="card" method="post" action="/cms/subscriptions/update">
    @csrf
    <input type="hidden" name="id" value="{{ !empty($subscriptions['_id']) ? $subscriptions['_id'] : '' }}" />
    <div class="card-body mb-3">
      <div class="row">
        <div class="col-6">
          <lable class="font-weight-bold">UID</lable>
          <p>{{ !empty($subscriptions['uid']) ? $subscriptions['uid'] :  '' }}</p>
        </div>
        <div class="col-6">
          <lable class="font-weight-bold">Order Date</lable>
          <p>{{ !empty($subscriptions['expiry_date']) ? date_format(date_create($subscriptions['expiry_date']),'d/m/Y') :  '' }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <lable class="font-weight-bold">Name</lable>
          <p>{{ !empty($subscriptions['user_name']) ? $subscriptions['user_name'] :  '' }}</p>
        </div>
        <div class="col-6">
          <lable class="font-weight-bold">User ID</lable>
          <p>{{ !empty($subscriptions['user_id']) ? $subscriptions['user_id'] :  '' }}</p>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <lable class="font-weight-bold">Product Type</lable>
          <p>{{ !empty($subscriptions['product_type']) ? $subscriptions['product_type'] :  '' }}</p>
        </div>
        <div class="col-6">
          <lable class="font-weight-bold">Product</lable>
          <p>{{ !empty($subscriptions['product_name']) ? $subscriptions['product_name'] :  '' }}</p>
        </div>
      </div>
    </div>
    <div class="card-body">
      <h3 class="font-22 font-weight-bold">Extend / End Subscription</h3>
      <div class="row">
        <div class="col-md-6">
          <label class="font-weight-bold mt-3">User ID</label>
          <input class="form-control" type="text" name="user_id" value="{{ !empty($subscriptions['user_id']) ? $subscriptions['user_id'] :  '' }}" />
        </div>
        <div class="col-md-6">
          <label class="font-weight-bold mt-3">User Name</label>
          <input class="form-control" type="text" name="user_name" value="{{ !empty($subscriptions['user_name']) ? $subscriptions['user_name'] :  '' }}" />
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label class="font-weight-bold mt-3">Expiry Date</label>
          <input type="hidden" name="existing_expiry_date" value="{{ !empty($subscriptions['expiry_date']) ? $subscriptions['expiry_date'] : '' }}" />
          <input class="form-control" type="datetime-local" class="form-control" name="new_expiry_date"  />
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center py-2">
          <input type="submit" class="btn btn-primary" value="Update Subscription" />
        </div>
      </div>
    </div>
  </form>

@stop