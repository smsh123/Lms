  @if(!empty($testimonials))
    <div id="reviews" class="theme-contrast-gradient-container position-relative py-5 wave_border_top_white px-3">
      <div class="position-relative bg-white mx-auto">
        <div class="mb-5 mw-450 mx-auto">
          <h3 class="font-32 font-weight-bold text-center">Reviews from Students</h3>
          <p class="font-14 text-center">We always welcome reviews and feedback on our product and services from our students and use it to enhace our quality of services and products.</p>
        </div>
        <div class="container">
          <div class="swiper swiper_with_progress">
            <div class="swiper-wrapper flex-nowrap justify-content-start no-gutters">
            @foreach ($testimonials as $key => $testimonial )
              <div class="swiper-slide  bg-transparent">
                <div class="card border-radius-25 border-0 w-100">
                  <div class="card-body">
                    <div class="icon-100 mx-auto mb-3">
                      <div class="ratio-image image_1-1 rounded-circle">
                        <img src="{{ !empty($testimonial['user_info']['avatar_image']) ? $testimonial['user_info']['avatar_image'] : '' }}" alt="testimonial_thumbnail" />
                      </div>
                    </div>
                    <h3 class="font-22 mb-3">{{ !empty($testimonial['user_info']['name']) ? $testimonial['user_info']['name'] : '' }}</h3>
                    <p class="card-text font-14">
                      <i class="bi bi-quote font-22"></i>
                      {{ !empty($testimonial['synopsis']) ? $testimonial['synopsis'] : '' }}
                    </p>
                  </div>
                </div>
              </div>
            @endforeach
            </div>
            <div class="swiper-pagination position-relative my-3"></div>
            <div class="autoplay-progress">
              <svg viewBox="0 0 48 48">
                <circle cx="24" cy="24" r="20"></circle>
              </svg>
              <span></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif