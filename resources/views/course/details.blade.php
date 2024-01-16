@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container-bottom position-relative">
    @if(!empty($CourseDescription))
      <div class="main-banner ratio-image image_1600-400 position-relative">
        <img src="{{ !empty($CourseDescription['banner_image']) ? $CourseDescription['banner_image'] : '/assets/image/main_banner.jpeg' }}" alt="main-banner" />
        <a href="#" class="btn-play d-none d-lg-block"></a>
      </div>
      <div class="container">
        <div class="row d-flex justify-content-between align-items-stretch flex-wrap">
          <div class="col-12 col-md-6 col-lg-8 order-2 order-lg-1">
            <div class="main-feature-bar">
              <div class="d-flex flex-wrap justify-content-between align-items-stretch">
                <div class="align-self-center mb-2">
                  <div class="bg-white icon-150 border-radius-10 text-center p-2">
                    <div class="mx-auto mb-2"><i class="bi bi-calendar-week font-32 text-primary"></i></div>
                    <div class="font-12 font-weight-bold text-capitalize">{{ !empty($CourseDescription['batch_start_date']) ? date_format(date_create($CourseDescription['batch_start_date']),'d F Y') : '' }}</div>
                  </div>
                </div>
                <div class="align-self-center mb-2">
                  <div class="bg-white icon-150 border-radius-10 text-center p-2">
                    <div class="mx-auto mb-2"><i class="bi bi-clock-history font-32 text-warning"></i></div>
                    <div class="font-12 font-weight-bold text-capitalize">{{ !empty($CourseDescription['duration']) ? $CourseDescription['duration'].' Days' : '' }}</div>
                  </div>
                </div>
                <div class="align-self-center mb-2">
                  <div class="bg-white icon-150 border-radius-10 text-center p-2">
                    <div class="mx-auto mb-2"><i class="bi bi-patch-check font-32 text-danger"></i></div>
                    <div class="font-12 font-weight-bold text-capitalize">{{ !empty($CourseDescription['validity']) ? $CourseDescription['validity'].' Days' : '365 Days' }}</div>
                  </div>
                </div>
                <div class="align-self-center mb-2">
                  <div class="bg-white icon-150 border-radius-10 text-center p-2">
                    <div class="mx-auto mb-2"><i class="bi bi-person-video3 font-32 text-success"></i></div>
                    <div class="font-12 font-weight-bold text-capitalize">{{ !empty($CourseDescription['class_mode']) ? $CourseDescription['class_mode'] : 'Class' }}</div>
                  </div>
                </div>
              </div>
            </div>
            <h3 class="font-22 mb-3 mt-4 font-weight-bold">About <span class="text-theme-contrast">{{ !empty($CourseDescription['name']) ? $CourseDescription['name'] : '' }}</span></h3>
            <div class="mb-2">
              {!! $CourseDescription['synopsis'] !!}
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4 order-1 order-lg-2">
            <div class="card border-0 rounded-0 course-checkout-card border-radius-10 overflow-hidden">
              <div class="ratio-image image_16-9 position-relative">
                <img src="{{ !empty($CourseDescription['thumbnail_image']) ? $CourseDescription['thumbnail_image'] : '/assets/image/default_thumb.jpeg' }}"  alt="{{ !empty($CourseDescription['name']) ? $CourseDescription['name'] : '' }}">
                <a href="#" class="btn-play d-block d-lg-none"></a>
              </div>
              <div class="card-body">
                @if(!empty($CourseDescription['class_mode']))
                  <p class="mb-1">
                    <span class="badge badge-warning text-white text-capitalize">{{ !empty($CourseDescription['class_mode']) ? str_replace('_',$CourseDescription['class_mode']) : '' }}</span>
                  </p>
                @endif
                <h5 class="card-title">{{ !empty($CourseDescription['name']) ? $CourseDescription['name'] : '' }}</h5>
                @php
                  $highlights = !empty($CourseDescription['highlights']) ? explode(',',$CourseDescription['highlights']) : '' ;
                @endphp
                @include('layouts.highlights_widget')
                <p class="card-text"><span class="font-weight-bold pr-2 align-middle font-22">{{ !empty($CourseDescription['selling_price']) ? '₹'.$CourseDescription['selling_price'].'/-' : '' }}</span><strike class="text-danger font-12 align-middle">{{ !empty($CourseDescription['original_price']) ? $CourseDescription['original_price'].'/-' : '' }}</strike></p>
                <p class="mb-0"><a href="/cart/{{ !empty($CourseDescription['slug']) ? $CourseDescription['slug'] : '' }}?type=course&id={{ !empty($CourseDescription['_id']) ? $CourseDescription['_id'] : '' }}" class="btn btn-lg btn-theme-contrast rounded-pill">{{ !empty($CourseDescription['selling_price']) && $CourseDescription['selling_price'] > 0 ? 'Buy Now' : 'Subscribe' }}</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
<div class="w-100">
  <div class="page_section_nav bg-white sticky-top mt-3 border  border-right-0 border-left-0 overflow-auto" style="top:0px;">
    <div class="container">
      <ul class="nav nav-pills nav-fill flex-nowrap">
        @if(!empty($modules))
          <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0)"  data-target="#modules" onclick="scroll_to_div('modules')">
              <div class="icon-24 mx-auto"><i class="bi bi-card-checklist font-22"></i></div>
              <span>Modules</span>
            </a>
          </li>
        @endif
        @if(!empty($tools))
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)"  data-target="#tools" onclick="scroll_to_div('tools')">
              <div class="icon-24 mx-auto"><i class="bi bi-braces font-22"></i></div>
              <span>Tools</span>
            </a>
          </li>
        @endif
        @if(!empty($teachers))
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)"  data-target="#faculties" onclick="scroll_to_div('faculties')">
              <div class="icon-24 mx-auto"><i class="bi bi-person-badge font-22"></i></div>
              <span>Faculties</span>
            </a>
          </li>
        @endif
        @if(!empty($testimonials))
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)"  data-target="#reviews" onclick="scroll_to_div('reviews')">
              <div class="icon-24 mx-auto"><i class="bi bi-list-stars font-22"></i></div>
              <span>Reviews</span>
            </a>
          </li>
        @endif
        @if(!empty($faqs))
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)"  data-target="#faqs" onclick="scroll_to_div('faqs')"> 
              <div class="icon-24 mx-auto"><i class="bi bi-question-diamond font-22"></i></div>
              <span>Faqs</span>
            </a>
          </li>
        @endif
      </ul>
    </div>
  </div>
  @include('layouts.modules_card')
  @include('layouts.tools_card')
  @include('layouts.skills_card')
  @include('layouts.success_stories')
  @include('layouts.mentors_slider')
  @include('layouts.reviews_slider')
  @include('layouts.story_slider')
  @include('layouts.faq')
</div>
  <script>
  function scroll_to_div(div_id)
    {
        var target_offset = $("#"+div_id).offset().top - 100;
        $('html,body').animate(
        {
            scrollTop: target_offset
        },
        'slow');
    }
  </script>
@stop

