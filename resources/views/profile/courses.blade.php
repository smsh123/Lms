@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="min-vh-100">
    @include('layouts.profile_common')
    @if(!empty($subscriptions))
    <div clas="bg-white py-3">
      <div class="container">
        <div class="d-flex flex-nowrap justify-content-between" onclick="history.back()" >
          <div class="align-self-center">
            <div class="icon-48">
              <span class="btn btn-light border-radius-10"><i class="bi bi-chevron-left font-16"></i></span>
            </div>
          </div>
          <div class="align-self-center flex-fill pl-3">
            <h3 class="font-16 font-weight-bold mb-0">My Courses</h3>
          </div>
        </div>
      </div>
    </div>
      @php
        dd($subscriptions);
      @endphp
    @else

    @endif
  </div>
@stop

