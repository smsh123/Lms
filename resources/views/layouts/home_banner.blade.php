
@php
  $banner_section = getBlockBySlug('home-banner');
@endphp
<div class="theme-contrast-gradient-container position-relative pt-5 wave_border_bottom_white">
    <div class="banner-section mx-auto">
      <div class="d-flex row align-items-stretch justify-content-between">
      @if(!empty($banner_section))
        <div class="col-12 col-md-12 col-lg-4 align-self-start text-center text-lg-left">
          <div class="main-msg">
              <h1 class="text-uppercase font-weight-bold">{{ !empty($banner_section['items'][0]) && !empty($banner_section['items'][0]['title']) ? $banner_section['items'][0]['title'] : '' }}</h1>
              <p>{{ !empty($banner_section['items'][0]) && !empty($banner_section['items'][0]['short_description']) ? $banner_section['items'][0]['short_description'] : '' }}</p>
              <p><a href="javascript:void(0)" class="btn btn-theme-contrast" onclick="openLoginWindow()">Start Smart Learning</a></p>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 align-self-end">
          <div class="ratio-image image_16-9 bg-transparent">
            <img src="{{ !empty($banner_section['items'][0]) && !empty($banner_section['items'][0]['image']) ? $banner_section['items'][0]['image'] : '' }}" alt="main-banner" />
          </div>
        </div>
      @endif
        <div class="col-12 col-md-6 col-lg-4 align-self-end">
          @include('layouts.lead_form')
        </div>
      </div>
    </div>
  </div>