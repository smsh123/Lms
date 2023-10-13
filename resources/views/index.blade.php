@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container min-vh-100 pt-5">
  <div class="banner-section mx-auto">
     <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide bg-transparent flex-wrap d-block text-left">
              {{-- <img src="/assets/image/logo.png" alt="Logo" class="h-auto" style="width:300px;" > --}}
              <h1 class="text-uppercase font-weight-bold">Smart Learning</h1>
              <p>Learn from industry smart teachers. We value your study and time. Our vision to provide smart learning experience to students.</p>
              <p><a href="#" class="btn btn-theme-contrast">Start Smart Learning</a></p>
          </div>
          <div class="swiper-slide">
            
          </div>
          <div class="swiper-slide">
            
          </div>
        </div>
        {{-- <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div> --}}
        {{-- <div class="swiper-scrollbar"></div> --}}
        <div class="swiper-pagination"></div>
      </div>
  </div>

      <div class="container-fluid">
      
      </div>
  </div>
@stop

