@extends('cms.layouts.master')
@section('body')
  <div class="row my-3">
    <div class="col-12 col-lg-6"><h1 class="font-weight-bold font-32 my-3 text-warning">Add Ticket</h1></div>
    <div class="col-12 col-lg-6 text-right"><a href="/cms/tickets" class="btn btn-lg btn-secondary">View Tickets</a></div>
  </div>


  <form class="card" method="post" action="/cms/tickets/store">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <select class="form-control select_to" name="user_id">
          @if(!empty($users))
            @foreach ($users as $key => $user)
              <option value="{{ !empty($user->_id) ? $user->_id : ''}}">{{ !empty($user->name) ? $user->name : ''}}({{ !empty($user->_id) ? $user->_id : ''}} - {{ !empty($user->email) ? $user->email : ''}} - {{ !empty($user->mobile) ? $user->mobile : ''}})</option>
            @endforeach
          @endif
        </select>
        @if ($errors->has('user_id'))
          <p class="text-danger">{{ $errors->first('user_id') }}</p>
        @endif
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="name" value="" />
        @if ($errors->has('name'))
          <p class="text-danger">{{ $errors->first('name') }}</p>
        @endif
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="mobile" value="" />
        @if ($errors->has('mobile'))
          <p class="text-danger">{{ $errors->first('mobile') }}</p>
        @endif
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="email" value="" />
        @if ($errors->has('email'))
          <p class="text-danger">{{ $errors->first('email') }}</p>
        @endif
      </div>
      <div class="form-group">
        <label>Select Product</label>
        <select class="form-control" name='product'>
          @if(!empty($subscriptions))
            @foreach ($subscriptions as $key => $subscription )
              <option value="{{ !empty($subscription['_id']) ? 'subscription_id-'.$subscription['_id'].',' : ''  }}{{ !empty($subscription['uid']) ? 'order_id-'.$subscription['uid'].',' : '' }}{{ !empty($subscription['product_name']) ? 'product -'.$subscription['product_name'].',' : '' }}{{ !empty($subscription['expiry_date']) ? 'expiry_date -'.$subscription['expiry_date'] : '' }}">{{ !empty($subscription['product_name']) ? $subscription['product_name'] : '' }}{{ !empty($subscription['uid']) ? '- ( order_id-'.$subscription['uid'].' )' : '' }}</option>
            @endforeach
            <option value="Other">Other</option>
          @endif
        </select>
      </div>
      <div class="form-group">
        <label>Problem Description</label>
        <textarea class="form-control" name="comment" placeholder="Describe Porblem here"></textarea>
        @if ($errors->has('comment'))
          <p class="text-danger">{{ $errors->first('comment') }}</p>
        @endif
      </div>
      <div class="form-group">
        <label>Problem Screenshot</label>
        <div class="input-group upload-image mb-3">
          <input id="inputImage" type="file" class="form-control"  placeholder="ScreenShot Image" />
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" onclick="CustomFunctions.uploadImage('inputImage','form-image-input','image-preview');" type="button" id="button-addon2">Upload</button>
          </div>
        </div>
        <input id="form-image-input" type="hidden" class="form-control" name="image" value="" />
        <div class="icon-200 mx-auto">
          <div class="ratio-image image_16-9 my-3">
            <img id="image-preview" src="" />
          </div>
        </div>
      </div>
      <div class="form-group text-center">
        <input type="submit" class="btn btn-theme-contrast" value="Submit" />
      </div>
    </div>
  </form>

@stop