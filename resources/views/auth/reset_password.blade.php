@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
   <div class="theme-contrast-gradient-container min-vh-100 position-relative pt-5 wave_border_bottom_white">
      <div class="card mw-768 mx-auto my-5">
        <div class="card-header bg-transparent">
          Reset Password for <span class="font-weight-bold mx-2">{{ !empty($user_email) ? $user_email : ''}}</span>
        </div>
        <div class="card-body">
          <form method="POST" action="/reset_password_with_token">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control" placeholder="New Password" name="password" />
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Re-enter Password" name="confirmed" />
            </div>
            <div class="form-group">
              <input type="hidden" name="email" value="{{ !empty($user_email) ? $user_email : ''}}" /> 
              <input type="hidden" name="token" value="{{ !empty($token) ? $token : ''}}" /> 
              <input type="submit" class="btn btn-theme-contrast" value="Submit" />
            </div>
          </form>
        </div>
      </div>
   </div>
@stop

