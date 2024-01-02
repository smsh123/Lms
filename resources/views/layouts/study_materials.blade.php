  @if(!empty($ebooks))
      <div class="px-5 bg-theme-contrast text-white py-5">
          <h3 class="font-32 font-weight-bold text-center">Assure Preparation</h3>
          <p class="font-14 text-center mb-5">We designed study materials like ebooks, articles, updates to assure the preparation.</p>
          <div class="py-2 mb-5 px-3 text-center"><a href="#" class="btn btn-outline-light rounded-pill">Start Study</a></div>
      </div>
      <div class="container mt-n5 px-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 ">
          @foreach ($ebooks as $key => $ebook )
            <div class="text-center card mb-3  col border-radius-25">
              <div class="card-header bg-white border-0 px-0 py-3">
                <div class="ratio-image image_16-9">
                  <img src="{{ !empty($ebook['thumbnail_image']) ? $ebook['thumbnail_image'] : '' }}" alt="{{ !empty($ebook['name']) ? $ebook['name'].' -Image' : '' }}" />
                </div>
              </div>
              <div class="card-body px-2">
                <h4 class="font-16">{{ !empty($ebook['name']) ? $ebook['name'] : '' }}</h4>
              </div>
              <div class="card-footer bg-transparent"> <a href="{{ !empty($ebook['slug']) ? '/course/'.$ebook['slug'] : '' }}" class="btn btn-theme-contrast rounded-pill"><i class="bi bi-filetype-pdf font-22 mx-2 align-middle"></i><span>Download Now</span></a></div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  @endif