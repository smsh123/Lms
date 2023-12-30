  @if(!empty($courses))
    <div class="theme-contrast-gradient-container position-relative py-5 wave_border_top_white px-3">
      <div class="position-relative mw-1050 mx-auto">
        <div class="mb-5 mw-450 mx-auto">
          <h3 class="font-32 font-weight-bold text-center">Our Personalised Courses</h3>
          <p class="font-14 text-center">We designed our courses that suits for all category of students. We match our programs pace with the students.</p>
        </div>
        <div class="swiper swiper_with_progress">
          <div class="swiper-wrapper row flex-nowrap justify-content-start">
          @foreach ($courses as $key => $course )
            <div class="swiper-slide  bg-transparent col-lg-4 col-10">
              <div class="card border-radius-25 w-100">
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
  @endif