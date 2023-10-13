@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container min-vh-100">
  <div class="banner-section">
     <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="https://cdn.magloft.com/github/swiper/images/page-001.jpg" />
          </div>
          <div class="swiper-slide">
            <img src="https://cdn.magloft.com/github/swiper/images/page-002.jpg" />
          </div>
          <div class="swiper-slide">
            <img src="https://cdn.magloft.com/github/swiper/images/page-003.jpg" />
          </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-scrollbar"></div>
        <div class="swiper-pagination"></div>
      </div>
  </div>

      <div class="container-fluid">
      
      </div>
  </div>
@stop

