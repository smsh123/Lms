@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container-bottom position-relative">
    <div class="container">
      <h1 class="font-weight-bold font-32 text-center py-3">Latest Blogs & Courses <span class="text-theme-contrast mx-2 py-2 align-middle border-5 border-primary border-top-0 border-right-0 border-left-0">{{ !empty($tag) ? $tag : ''}}</span></h1>
      @if(!empty($courses))
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-sm-2">
         @foreach ($courses as $key => $course )
          <div class="col mb-4">
            <div class="card h-100 border-radius-10">
              <div class="ratio-image image_16-9">
                <img src="{{ !empty($course['thumbnail_image']) ? $course['thumbnail_image'] : '' }}" class="card-img-top" alt="{{ !empty($course['name']) ? $course['name'] : '' }}">
              </div>
              <div class="card-body">
                <h5 class="card-title font-16">{{ !empty($course['name']) ? $course['name'] : '' }}</h5>
                <p class="card-text"><span class="font-weight-bold pr-2 align-middle font-22">{{ !empty($course['selling_price']) ? '₹'.$course['selling_price'].'/-' : '' }}</span><strike class="text-danger font-12 align-middle">{{ !empty($course['original_price']) ? $course['original_price'].'/-' : '' }}</strike></p>
                <p class="mb-0"><a href="/course/{{ !empty($course['slug']) ? $course['slug'] : '' }}" class="btn btn-theme-contrast rounded-pill stretched-link">{{ !empty($course['selling_price']) && $course['selling_price'] > 0 ? 'Buy Now' : 'Subscribe' }}</a></p>
              </div>
            </div>
          </div>
         @endforeach
        </div>
      @else
        <div class="alert alert-danger text-center my-5 text-center font-weight-bold">
          There have no data to display! Don't Worry we will update it soon please retune after some time.
        </div>
      @endif
    </div>
  </div>
  
@stop

