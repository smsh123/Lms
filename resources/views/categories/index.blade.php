@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="min-vh-100 bg-white">
    @if(!empty($categories))
        <h1 class="font-32 font-weight-bold text-center my-3">Categories</h1>

        <div class="container">
            <div class="row d-flex justify-content-between align-items-stretch flex-wrap">
            
                @foreach ($categories as $key => $category )
                    <div class="col-6 col-md-4 col-lg-3 align-self-stretch">
                        <div class="card border-radius-10 h-100">
                            <div class="card-body">
                                <div class="ratio-image image_16-9 mb-3">
                                    <img src="{{ !empty($category['thumbnail_image']) ? $category['thumbnail_image'] : ''}}" alt="cat thumb" />
                                </div>
                                <p class="mb-0"><a href="{{ !empty($category['slug']) ? '/categories/'.$category['slug'] : ''}}" class="card-link text-dark font-14 stretched-link">{{ !empty($category['name']) ? $category['name'] : ''}}</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="container">
            <div class="alert alert-danger font-weight-bold text-center">Sorry! Something went wrong. No Data To Display.</div>
        </div>
    @endif
  </div>
@stop

