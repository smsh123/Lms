@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container-bottom position-relative py-3">
    <div class="container bg-white py-3">
      @if(!empty($BlogDescription))
      <h1>{{ !empty($BlogDescription['name']) ? $BlogDescription['name'] : '' }}</h1>
      <p>{{ !empty($BlogDescription['synopsis']) ? $BlogDescription['synopsis'] : '' }}</p>
      @if(!empty($BlogDescription['description']))
        <div>
          {!! $BlogDescription['description'] !!}      
        </div>
      @endif
      @else
        <div class="alert alert-danger text-center my-5 text-center font-weight-bold">
          Something Went Wrong!!.
        </div>
      @endif
    </div>
  </div>
  @include('layouts.footer')
@stop

