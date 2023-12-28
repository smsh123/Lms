@if (!empty($successStories))
  <div class="theme-contrast-gradient-container position-relative py-5 wave_border_top_white">
    <div class="position-relative">
      <h3 class="font-32 font-weight-bold text-center">Browse Your Success with Success Stories </h3>
      <p class="font-14 text-center mb-5">Student's tells their success stories and we feel prod that given them mentorship.</p>
      <div class="py-2 mb-5 px-3 text-center"><a href="#" class="btn btn-outline-primary rounded-pill">Browse All Stories</a></div>

      <div class="swiper card_swiper">
        <div class="swiper-wrapper no-gutters">
          @foreach($successStories as $key => $testimonial)
            <div class="swiper-slide col-4 video-card">
              <div class="ratio-image image_16-9">
                <a class="card-link stretched-link" href="{{ !empty($testimonial['video']) ? $testimonial['video'] : '' }}">
                  <div class="btn-play" data-url="{{ !empty($testimonial['video']) ? $testimonial['video'] : '' }}"></div>
                </a>
                <img src="{{ !empty($testimonial['thumbnail_image']) ? $testimonial['thumbnail_image'] : ''}}" />
              </div>
            </div>
          @endforeach
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
@endif
