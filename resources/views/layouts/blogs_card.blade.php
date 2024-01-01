@if (!empty($blogs))
  <div class="position-relative">
    <div class="mb-3">
      <h3 class="font-22 font-weight-bold">More Stories From Authors</h3>
    </div>
    <div class="row flex-nowrap justify-content-start">
      @foreach ($blogs as $key => $blog )
        @if($key == 8) @break @endif
        <div class="col-lg-4 col-md-6 col-12">
          <div class="card border-radius-25">
            <div class="card-header bg-transparent p-0 border-0">
              <div class="ratio-image image_16-9 bg-transparent">
                <img src="{{ !empty($blog['thumbnail_image']) ? $blog['thumbnail_image'] : '' }}" alt="blog_thumbnail" />
              </div>
            </div>
            <div class="card-body text-center">
              <h3 class="font-14">{{ !empty($blog['name']) ? $blog['name'] : '' }} </h3>
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
  </div>
@endif