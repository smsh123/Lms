@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container-bottom position-relative">
    <div class="container py-3">
      @if(!empty($CourseDescription))
        <div class="card border-0 blurry_white_bg border-radius-25">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 order-2 order-lg-1">
                @if(!empty($CourseDescription['class_mode']))
                  <p class="mb-1">
                    <span class="badge badge-warning text-white text-capitalize">{{ !empty($CourseDescription['class_mode']) ? $CourseDescription['class_mode'] : '' }}</span>
                  </p>
                @endif
                <h1 class="font-weight-bold font-22">{{ !empty($CourseDescription['name']) ? $CourseDescription['name'] : '' }}</h1>
                <p>{{ !empty($CourseDescription['synopsis']) ? $CourseDescription['synopsis'] : '' }}</p>
                @php
                  $highlights = !empty($CourseDescription['highlights']) ? explode(',',$CourseDescription['highlights']) : '' ;
                @endphp
                @include('layouts.highlights_widget')
                <p class="card-text"><span class="font-weight-bold pr-2 align-middle font-22">{{ !empty($CourseDescription['selling_price']) ? '₹'.$CourseDescription['selling_price'].'/-' : '' }}</span><strike class="text-danger font-12 align-middle">{{ !empty($CourseDescription['original_price']) ? $CourseDescription['original_price'].'/-' : '' }}</strike></p>
                  <p class="mb-0"><a href="/cart/{{ !empty($CourseDescription['slug']) ? $CourseDescription['slug'] : '' }}?type=course&id={{ !empty($CourseDescription['_id']) ? $CourseDescription['_id'] : '' }}" class="btn btn-lg btn-theme-contrast rounded-pill">{{ !empty($CourseDescription['selling_price']) && $CourseDescription['selling_price'] > 0 ? 'Buy Now' : 'Subscribe' }}</a></p>
              </div>
              <div class="col-md-6 order-1 order-lg-2">
                <div class="ratio-image image_16-9 border-radius-10 mb-2">
                  <img src="{{ !empty($CourseDescription['thumbnail_image']) ? $CourseDescription['thumbnail_image'] : '' }}" class="card-img-top" alt="{{ !empty($CourseDescription['name']) ? $CourseDescription['name'] : '' }}">
                </div>
              </div>
            </div>
          </div>
        </div>
        @if(!empty($CourseDescription['description']))
          <div class="container my-3 px-0">
            <div class="card border-radius-25 mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-8">
                        <h3 class="font-22 mb-3 font-weight-bold">About <span class="text-theme-contrast">{{ !empty($CourseDescription['name']) ? $CourseDescription['name'] : '' }}</span></h3>
                        {!! $CourseDescription['description'] !!}
                    
                  </div>
                  <div class="col-lg-4">
                    <div class="card">
                      <div class="card-body text-center">
                          @if(!empty($CourseDescription['batch_start_date']))
                            <p class="mb-1 p-2 bg-theme-contrast text-white">New Batch</p>
                            <p class="font-22 font-weight-bold">{{ !empty($CourseDescription['batch_start_date']) ? date_format(date_create($CourseDescription['batch_start_date']),'d/m/Y') : '' }}</p>
                          @endif
                          @if(!empty($CourseDescription['duration']))
                            <p class="mb-1 p-2 bg-theme-contrast text-white">Course Duration</p>
                            <p class="font-22 font-weight-bold">{{ !empty($CourseDescription['duration']) ? $CourseDescription['duration'].' Days' : '' }}</p>
                          @endif

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endif
      @else
        <div class="alert alert-danger text-center my-5 text-center font-weight-bold">
          There have no courses to display! Don't Worry we will update it soon please retune after some time.
        </div>
      @endif
    </div>
  </div>

 
  @include('layouts.modules_card')
  @include('layouts.success_stories')
  @include('layouts.mentors')
  @include('layouts.story_slider')
  @include('layouts.testimonial')
@stop

