@if (!empty($blogs))
  <div class="theme-contrast-gradient-container position-relative py-5 px-3">
    <div class="position-relative mw-1050 mx-auto">
      <div class="mb-5 mw-450 mx-auto">
        <h3 class="font-32 font-weight-bold text-center">Stories From Authors</h3>
        <p class="font-14 text-center">Our Blog writters push daily updates on our new offerings and latest offers and course structure on our blog section.</p>
      </div>
      <div class="swiper swiper_with_progress">
        <div class="swiper-wrapper row flex-nowrap justify-content-start">
        @foreach ($blogs as $key => $blog )
          <div class="swiper-slide bg-transparent col-lg-4 col-10">
            <div class="card border-radius-25">
              <div class="card-header bg-transparent p-0 border-0">
                <div class="ratio-image image_16-9 bg-transparent">
                  <img src="{{ !empty($blog['thumbnail_image']) ? $blog['thumbnail_image'] : '' }}" alt="blog_thumbnail" />
                </div>
              </div>
              <div class="card-body">
                <h3 class="font-16">{{ !empty($blog['name']) ? $blog['name'] : '' }} </h3>
                {{-- <div class="d-flex flex-nowrap">
                  <div class="align-self-center p-3">
                    <div class="icon-48">
                      <div class="ratio-image image_1-1 rounded-circle">
                        <img src="https://img.freepik.com/premium-photo/young-man-is-holding-book-smiling_905085-17.jpg" alt="author_image" />
                      </div>
                    </div>
                  </div>
                  <div class="flex-fill p-3 align-self-center text-left">
                    <p class="mb-0 font-14">Nikesh Bhardwaj</p>
                    <p class="text-muted mb-0"><i class="bi bi-calendar font-14 align-middle text-theme"></i><span class="align-center mx-2 font-12">12 Oct 2023</span></p>
                  </div> 
                </div>--}}
                <p class="mb-0"><a href="/blogs/{{ !empty($blog['slug']) ? $blog['slug'] : '' }}" class="stretched-link btn btn-theme-contrast">Read More</a></p>
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