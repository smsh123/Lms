@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="theme-contrast-gradient-container-bottom position-relative py-3">
    <div class="container bg-white py-3">
      <div class="row">
        <div class="col-lg-8">
          @if(!empty($BlogDescription))
            @php
              $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              $caption = !empty($BlogDescription['name']) ? $BlogDescription['name'] : 'Blog Title';
            @endphp
            <h1>{{ !empty($BlogDescription['name']) ? $BlogDescription['name'] : '' }}</h1>
            @include('layouts.share_widget')
            <p class="bg-light-blue p-3 border-radius-10">{{ !empty($BlogDescription['synopsis']) ? $BlogDescription['synopsis'] : '' }}</p>
            @if(!empty($BlogDescription['thumbnail_image']))
              <div class="ratio-image image_16-9 my-3">
                <img src="{{ !empty($BlogDescription['thumbnail_image']) ? $BlogDescription['thumbnail_image'] : '' }}" alt="blog-image" />
              </div>
            @endif
            @if(!empty($BlogDescription['description']))
              <div class="story_details_container">
                {!! $BlogDescription['description'] !!}      
              </div>
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
            @endif
            @if(!empty($author))
              <div class="card border-radius-25">
                <div class="card-body">
                  <div class="d-flex flex-wrap">
                    <div class="align-self-center">
                      <div class="icon-150 mx-auto">
                        <div class="ratio-image image_1-1 bg-transparent rounded-circle">
                          <img src="{{ !empty($author['avatar_image']) ? $author['avatar_image'] : ''}}" alt="{{ !empty($author['name']) ? $author['name'] : ''}}" />
                        </div>
                      </div>
                    </div>
                    <div class="align-self-center flex-fill pl-5 text-center text-lg-left">
                      <h3 class="font-weight-bold text-theme">{{ !empty($author['name']) ? $author['name'] : ''}}</h3>
                      <p class="mb-0"><i class="bi bi-briefcase font-22 align-middle text-theme-contrast"></i><span class="align-center mx-2 font-14">{{ !empty($author['expertise']) ? $author['expertise'] : 'Star Faculty'  }}</span></p>
                      <p class="mb-0"><i class="bi bi-mortarboard font-22 align-middle text-theme-contrast"></i><span class="align-center mx-2 font-14">{{ !empty($author['qualification']) ? $author['qualification'] : 'Academics'  }}</span></p>
                      <ul class="list-unstyled my-3">
                        @if(!empty($author['facebook_profile']))
                          <li class="d-inline-block mr-2">
                              <a class="facebook auw_event_share icon-facebook" share-type="facebook" href="{{ $author['facebook_profile'] }}">
                                <i class="bi bi-facebook"></i>
                              </a>
                          </li>
                        @endif
                        @if(!empty($author['x_profile']))
                          <li class="d-inline-block mr-2">
                              <a class="twitter auw_event_share icon-twitter" share-type="twitter" href="{{ $author['x_profile'] }}" >
                                <i class="bi bi-twitter-x"></i>
                              </a>
                          </li>
                        @endif
                        @if(!empty($author['linkedin_profile']))
                          <li class="d-inline-block mr-2">
                              <a class="whatsapp auw_event_share icon-whatsapp" share-type="whatsapp" href="{{ $author['linkedin_profile'] }}" >
                                <i class="bi bi-linkedin"></i>
                              </a>
                          </li>
                        @endif
                        @if(!empty($author['youtube_profile']))
                          <li class="d-inline-block mr-2">
                              <a class="whatsapp auw_event_share icon-whatsapp" share-type="whatsapp" href="{{ $author['youtube_profile'] }}">
                                <i class="bi bi-youtube"></i>
                              </a>
                          </li>
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            @endif
            @if(!empty($blogs))
              @include('layouts.blogs_card')
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

