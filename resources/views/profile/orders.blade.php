@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="min-vh-100 container">
    <div class="row no-gutters">
      <div class="col-12 col-lg-4 d-none d-none d-lg-block">
        @include('layouts.profile_common')
      </div>
      <div class="col-12 col-lg-8">
        @include('layouts.profile_common_nav')
        <h3 class="font-weight-bold font-22 text-center">My Orders</h3>
      </div>
    </div>
  </div>
@stop

