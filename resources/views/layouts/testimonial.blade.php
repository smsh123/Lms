  
   @if(!empty($videoTestimonial))
    <section class="py-5 mb-5">
      <div class="px-5">
            <h3 class="font-32 font-weight-bold text-center">Students Writes About Classes on Wall</h3>
            <p class="font-14 text-center ">Student's tells their feedback and we feel prod that given them mentorship.</p>
            <div class="py-2 mb-5 pb-5 px-3 text-center"><a href="#" class="btn btn-outline-secondary rounded-pill">Browse All Testimonial</a></div>
        </div>
        <div class="container">
          <div class="row align-items-start">
          @foreach ($videoTestimonial as $testimonial)
            <div class="col col-12 col-lg-3 text-center">
              <div class="icon-200 mx-auto mt-n5 mb-3">
                <div class="ratio-image image_1-1 border-radius-25">
                  <img src="{{ !empty($testimonial['thumbnail_image']) ? $testimonial['thumbnail_image'] : ''}}" alt="user image" />
                </div>
              </div>
              <h4 class="font-22">Surjeet Singh</h4>
              <p class="font-14">Patna</p>
              <a href="{{ !empty($testimonial['video']) ? $testimonial['video'] : ''}}" class="btn btn-theme-contrast rounded-pill"><i class="bi bi-play-btn font-22 mx-2 align-middle"></i><span>Watch Now</span></a>
            </div>
          @endforeach
          </div>
        </div>
      </div>
    </section>
   @endif