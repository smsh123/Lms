@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container-bottom position-relative">
    <div class="container py-3">
      @if(!empty($CourseDescription))
        <div class="container">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <h1 class="font-weight-bold font-22">{{ !empty($CourseDescription['name']) ? $CourseDescription['name'] : '' }}</h1>
                  <p>{{ !empty($CourseDescription['synopsis']) ? $CourseDescription['synopsis'] : '' }}</p>
                  @if(!empty($CourseDescription['batch_start_date']))
                    <p class="font-weight-bold">{{  $CourseDescription['batch_start_date'] }}</p>
                  @endif
                  <p class="card-text"><span class="font-weight-bold pr-2 align-middle font-22">{{ !empty($CourseDescription['selling_price']) ? '₹'.$CourseDescription['selling_price'].'/-' : '' }}</span><strike class="text-danger font-12 align-middle">{{ !empty($CourseDescription['original_price']) ? $CourseDescription['original_price'].'/-' : '' }}</strike></p>
                   <p class="mb-0"><a href="/cart/{{ !empty($CourseDescription['slug']) ? $CourseDescription['slug'] : '' }}?type=course&id={{ !empty($CourseDescription['_id']) ? $CourseDescription['_id'] : '' }}" class="btn btn-lg btn-theme-contrast rounded-pill stretched-link">{{ !empty($CourseDescription['selling_price']) && $CourseDescription['selling_price'] > 0 ? 'Buy Now' : 'Subscribe' }}</a></p>
                </div>
                <div class="col-md-6">
                  <div class="ratio-image image_16-9">
                    <img src="{{ !empty($CourseDescription['thumbnail_image']) ? $CourseDescription['thumbnail_image'] : '' }}" class="card-img-top" alt="{{ !empty($CourseDescription['name']) ? $CourseDescription['name'] : '' }}">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @else
        <div class="alert alert-danger text-center my-5 text-center font-weight-bold">
          There have no courses to display! Don't Worry we will update it soon please retune after some time.
        </div>
      @endif
    </div>
  </div>


  @include('layouts.success_stories')
  @include('layouts.mentors')
  @include('layouts.story_slider')
  @include('layouts.testimonial')

  @include('layouts.footer')
@stop

