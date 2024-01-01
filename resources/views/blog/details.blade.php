@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container-bottom position-relative py-3">
    <div class="container bg-white py-3">
      <div class="row">
        <div class="col-lg-8">
          @if(!empty($BlogDescription))
            <h1>{{ !empty($BlogDescription['name']) ? $BlogDescription['name'] : '' }}</h1>
            @include('layouts.share_widget')
            <p class="bg-light-blue p-3 border-radius-10">{{ !empty($BlogDescription['synopsis']) ? $BlogDescription['synopsis'] : '' }}</p>
            @if(!empty($BlogDescription['thumbnail_image']))
              <div class="ratio-image image_16-9 my-3">
                <img src="{{ !empty($BlogDescription['thumbnail_image']) ? $BlogDescription['thumbnail_image'] : '' }}" alt="blog-image" />
              </div>
            @endif
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
        <div class="col-lg-4">
          @include('layouts.lead_form')
          @if(!empty($courses))
            <h3 class="font-weight-bold font-22 my-3">Courses</h3>
            @foreach ($courses as $key => $course )
              @if($key == 3) @break @endif
              <div class="card border-radius-25 w-100 mb-3">
                <div class="card-header bg-transparent p-0">
                  <div class="ratio-image image_16-9 bg-transparent">
                    <img src="{{ !empty($course['thumbnail_image']) ? $course['thumbnail_image'] : '' }}" alt="course_thumbnail" />
                  </div>
                </div>
                <div class="card-body">
                  <h3 class="font-16">{{ !empty($course['name']) ? $course['name'] : '' }}</h3>
                  <p class="card-text"><span class="font-weight-bold pr-2 align-middle font-22">{{ !empty($course['selling_price']) ? '₹'.$course['selling_price'].'/-' : '' }}</span><strike class="text-danger font-12 align-middle">{{ !empty($course['original_price']) ? $course['original_price'].'/-' : '' }}</strike></p>
                  <p class="mb-0"><a href="/course/{{ !empty($course['slug']) ? $course['slug'] : '' }}" class="stretched-link btn btn-theme">{{ !empty($course['selling_price']) && $course['selling_price'] > 0 ? 'Buy Now' : 'Subscribe' }}</a></p>
                </div>
              </div>
            @endforeach
          @endif
          @if(!empty( $BlogDescription['tags']))
            @php
              $tags = explode(',',$BlogDescription['tags']);
            @endphp
            @if(!empty($tags))
              <h3 class="font-weight-bold font-22 mb-3">Tags</h3>
              @foreach ($tags as $key => $tag )
                <a href="{{ !empty($tag) ? '/tags/'.str_replace(' ','-',$tag) : '' }}" class="btn btn-rounded-pill btn-light mb-3 mr-2">{{ !empty($tag) ? $tag : ''}}</a>
              @endforeach
            @endif
          @endif
        </div>
      </div>
    </div>
  </div>
  @include('layouts.footer')
@stop

