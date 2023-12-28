@if (!empty($teachers))
  <div class="container py-3 my-5 overflow-hidden">
    <div class="d-flex row align-items-stretch">
      <div class="mb-5 mw-450 mx-auto col-12 col-lg-6 align-self-center">
        <h3 class="font-32 font-weight-bold text-center">Our Experts You Mentors</h3>
        <p class="font-14 text-center">We have very highly experienced faculties who serve you with their expertise and knowledge.</p>
        <p class="text-center mt-3"><a href="#" class="btn btn-theme-contrast">Meet Our Mentors</a></p>
      </div>
      <div class="col-12 col-lg-6 align-self-center">
        <div class="swiper card-swiper">
          <div class="swiper-wrapper">
            @foreach ($teachers as $key => $teacher )
              <div class="swiper-slide align-items-start" style="min-height:350px;">
                <div class="card h-100 w-100">
                  <div class="card-header border-0 bg-transparent p-0 mb-n3">
                    <div class="image-profile-cover">
                      <img src="{{ !empty($teacher['cover_image']) ? $teacher['cover_image'] : 'https://i.pinimg.com/564x/0a/50/ca/0a50cac2f966b2dbe0466872bc0532bf.jpg'  }}" />
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-lg-start justify-content-center">
                      <div class="align-self-start px-3">
                        <div class="icon-150 mt-n5">
                          <div class="ratio-image image_1-1 rounded-circle border border-white">
                            <img src="{{ !empty($teacher['avatar_image']) ? $teacher['avatar_image'] : '/assets/avatars/user_default.png'  }}" alt="author_image" />
                          </div>
                        </div>
                      </div>
                      <div class="flex-fill p-3 align-self-middle text-center text-lg-left">
                        <p class="mb-0">{{ !empty($teacher['name']) ? $teacher['name'] : 'Teacher Ji'  }}</p>
                        <p class="mb-0"><i class="bi bi-briefcase font-22 align-middle text-theme-contrast"></i><span class="align-center mx-2 font-14">{{ !empty($teacher['expertise']) ? $teacher['expertise'] : 'Star Faculty'  }}</span></p>
                        <p class="mb-0"><i class="bi bi-mortarboard font-22 align-middle text-theme-contrast"></i><span class="align-center mx-2 font-14">{{ !empty($teacher['qualification']) ? $teacher['qualification'] : 'Academics'  }}</span></p>
                        <ul class="list-unstyled my-3">
                          @if(!empty($teacher['facebook_profile']))
                            <li class="d-inline-block mr-2">
                                <a class="facebook auw_event_share icon-facebook" share-type="facebook" href="{{ $teacher['facebook_profile'] }}">
                                  <i class="bi bi-facebook"></i>
                                </a>
                            </li>
                          @endif
                          @if(!empty($teacher['x_profile']))
                            <li class="d-inline-block mr-2">
                                <a class="twitter auw_event_share icon-twitter" share-type="twitter" href="{{ $teacher['x_profile'] }}" >
                                  <i class="bi bi-twitter-x"></i>
                                </a>
                            </li>
                          @endif
                          @if(!empty($teacher['linkedin_profile']))
                            <li class="d-inline-block mr-2">
                                <a class="whatsapp auw_event_share icon-whatsapp" share-type="whatsapp" href="{{ $teacher['linkedin_profile'] }}" >
                                  <i class="bi bi-linkedin"></i>
                                </a>
                            </li>
                          @endif
                          @if(!empty($teacher['youtube_profile']))
                            <li class="d-inline-block mr-2">
                                <a class="whatsapp auw_event_share icon-whatsapp" share-type="whatsapp" href="{{ $teacher['youtube_profile'] }}">
                                  <i class="bi bi-youtube"></i>
                                </a>
                            </li>
                          @endif
                      </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      
    </div>
  </div>
@endif