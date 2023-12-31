  @if(!empty($ebooks))
    <section class="py-5 mb-5">
      <div class="px-5 bg-theme-contrast text-white py-5">
            <h3 class="font-32 font-weight-bold text-center">Assure Preparation</h3>
            <p class="font-14 text-center mb-5">We designed study materials like ebooks, articles, updates to assure the preparation.</p>
            <div class="py-2 mb-5 px-3 text-center"><a href="#" class="btn btn-outline-light rounded-pill">Start Study</a></div>
        </div>
        <div class="container">
          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 ">
            @foreach ($ebooks as $key => $ebook )
              <div class="text-center card mb-5 col">
                <div class="w-100 mx-auto mt-0 mt-lg-n5 mb-3">
                  <div class="ratio-image image_16-9 border-radius-25">
                    <img src="{{ !empty($ebook['thumbnail_image']) ? $ebook['thumbnail_image'] : '' }}" alt="{{ !empty($ebook['name']) ? $ebook['name'].' -Image' : '' }}" />
                  </div>
                </div>
                <div class="card-body">
                  <h4 class="font-22">{{ !empty($ebook['name']) ? $ebook['name'] : '' }}</h4>
                </div>
                <div class="card-footer bg-transparent"> <a href="{{ !empty($ebook['slug']) ? '/course/'.$ebook['slug'] : '' }}" class="btn btn-theme-contrast rounded-pill"><i class="bi bi-filetype-pdf font-22 mx-2 align-middle"></i><span>Download Now</span></a></div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
  @endif