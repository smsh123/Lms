@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container-bottom position-relative">
    <div class="container">
      <h1 class="font-weight-bold font-32 text-center py-3">Stories from Our Writters</h1>
      @if(!empty($blogs))
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 row-cols-sm-2">
         @foreach ($blogs as $key => $blog )
          <div class="col mb-4">
            <div class="card h-100 border-radius-10">
              <div class="ratio-image image_16-9">
                <img src="{{ !empty($blog['thumbnail_image']) ? $blog['thumbnail_image'] : '' }}" class="card-img-top" alt="{{ !empty($blog['name']) ? $blog['name'] : '' }}">
              </div>
              <div class="card-body">
                <h5 class="card-title font-16">{{ !empty($blog['name']) ? $blog['name'] : '' }}</h5>
                <p class="mb-0"><a href="/blogs/{{ !empty($blog['slug']) ? $blog['slug'] : '' }}" class="btn btn-theme-contrast rounded-pill stretched-link">Read More</a></p>
              </div>
            </div>
          </div>
         @endforeach
        </div>
      @else
        <div class="alert alert-danger text-center my-5 text-center font-weight-bold">
          There have no courses to display! Don't Worry we will update it soon please retune after some time.
        </div>
      @endif
    </div>
  </div>
  @include('layouts.footer')
@stop

