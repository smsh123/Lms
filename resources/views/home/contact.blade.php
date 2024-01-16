@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="d-flex row align-items-stretch justify-content-around no-gutters">
      <div class="col-md-3 col-lg-4 bg-info text-white min-vh-100 d-md-block d-none" style="background-image:url(https://spiderimg1.safalta.com/assets/images/safalta.com/2024/01/16/643353_65a6624de4b22.png); background-size:cover; background-position:center; background-repeat:no-repeat;">
      </div>
      <div class="col-md-9 col-lg-8">
          <div class="h-100 overflow-auto bg-white sticky-top">
              <div class="sticky-top">
                  <div class="bg-light py-5 shadow-sm"></div>
                  <h1 class="mt-n4  text-center"><span class="rounded-pill btn btn-light shadow-sm px-5" style="font-size:32px;">Contact Us</span></h1>
              </div>
              <div class="container py-4">
                  <div class="row">
                      <div class="col-lg-6 text-center">
                          @if(!empty($brandDetails))
                              <h3 class="font-22">{{ !empty($brandDetails['name']) ? $brandDetails['name'] : 'Brand Name' }}</h3>
                              <p>{{ !empty($brandDetails['address']) ? $brandDetails['address'] : 'Brand Address' }}</p>
                              <div class="d-flex justify-content-center flex-wrap align-items-stretch my-3">
                                <div class="align-self-start">
                                    <div class="card border-radius-10 h100">
                                        <div class="card-body">
                                            <div class="icon-48 mb-2 mx-auto">
                                                <i class="bi bi-telephone text-info font-32 "></i>
                                            </div>
                                            <a href="tel:{{ !empty($brandDetails['phone']) ? '+91'.$brandDetails['phone'] : '-' }}" class="card-link stretched-link text-dark">{{ !empty($brandDetails['phone']) ? '+91'.$brandDetails['phone'] : '-' }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="align-self-start">
                                    <div class="card border-radius-10 h100">
                                        <div class="card-body">
                                            <div class="icon-48 mb-2 mx-auto">
                                                <i class="bi bi-envelope-at text-warning font-32"></i>
                                            </div>
                                            <a href="mailto:{{ !empty($brandDetails['email']) ? $brandDetails['email'] : '-' }}" class="card-link stretched-link text-dark">{{ !empty($brandDetails['email']) ? $brandDetails['email'] : '-' }}</a>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <ul class="d-flex justify-content-center align-items-stretch my-3 mx-0 p-0 list-no-style">
                                @if(!empty($brandDetails['facebook']) )
                                  <li class="p-1 align-self-center card-link">
                                    <a href="{{ $brandDetails['facebook'] }}" class="text-primary">
                                      <i class="bi bi-facebook font-32"></i>
                                    </a>
                                  </li>
                                @endif
                                @if(!empty($brandDetails['twitter']) )
                                  <li class="p-1 align-self-center card-link">
                                    <a href="{{ $brandDetails['twitter'] }}" class="text-dark">
                                      <i class="bi bi-twitter-x font-32"></i>
                                    </a>
                                  </li>
                                @endif
                                @if(!empty($brandDetails['youtube']) )
                                  <li class="p-1 align-self-center card-link">
                                    <a href="{{ $brandDetails['youtube'] }}" class="text-danger">
                                      <i class="bi bi-youtube font-32"></i>
                                    </a>
                                  </li>
                                @endif
                                @if(!empty($brandDetails['instagram']) )
                                  <li class="p-1 align-self-center card-link">
                                    <a href="{{ $brandDetails['instagram'] }}" class="text-danger">
                                      <i class="bi bi-instagram font-32"></i>
                                    </a>
                                  </li>
                                @endif
                                @if(!empty($brandDetails['linkedin']) )
                                  <li class="p-1 align-self-center card-link">
                                    <a href="{{ $brandDetails['linkedin'] }}" class="text-primary">
                                      <i class="bi bi-linkedin font-32"></i>
                                    </a>
                                  </li>
                                @endif
                              </ul>
                          @endif
                          <div class="py-2 my-2 border border-right-0 border-bottom-0 border-left-0"></div>
                          <div class="card mw-450 w-100 mx-auto border-0">
                              <div class="card-body p-0 bg-white">
                                  <div class="ratio-image image_16-9 rounded">
                                      <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d14011.555266475312!2d77.3668853!3d28.6031121!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1703758203714!5m2!1sen!2sin"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                        @include('layouts.lead_form')
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@stop

