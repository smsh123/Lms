@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="min-vh-100 bg-white">
    @if(!empty($categoryDescription))
        <h1 class="font-32 font-weight-bold text-center my-3">{{ !empty($categoryDescription['name']) ? $categoryDescription['name'] : '' }}</h1>
        <p class="p-3 border-radius-10 my-3">{{ !empty($categoryDescription['synopsis']) ? $categoryDescription['synopsis'] : ''}}</p>
        <div class="container">
            {!! !empty($categoryDescription['description']) ? $categoryDescription['description'] : ''!!}
        </div>
    @else
        <div class="container">
            <div class="alert alert-danger font-weight-bold text-center">Sorry! Something went wrong. No Data To Display.</div>
        </div>
    @endif
  </div>
@stop

