@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="min-vh-100 container">
    <div class="row no-gutters">
      <div class="col-12">
        @include('layouts.profile_common')
        
         <h3 class="font-weight-bold font-22 text-center">My Courses</h3>
      </div>
    </div>
  </div>
@stop

