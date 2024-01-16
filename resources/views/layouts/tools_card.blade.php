  @if(!empty($tools))
    <div class="container mt-4" id="tools">
      <div class="card border-0">
        <div class="card-header bg-transparent border-0">
          <h3 class="font-22 font-weight-bold mb-0"><span class="text-theme-contrast pr-2">Tools</span>We Will Learn</h3>
        </div>
        <div class="card-body">
          <div class="row">
            @foreach ($tools as $key => $tool)
              <div class="col-lg-3 col-md-4 col-6 text-center">
                <div class="card border-radius-10">
                  <div class="card-body p-2">
                    <div class="w-100 mx-auto">
                      <div class="ratio-image image_16-9 mb-2 bg-transparent">
                        <img src="{{ !empty($tool['thumbnail_image']) ? $tool['thumbnail_image'] : '/assets/image/default_thumb.jpeg'}}" alt="{{ !empty($tool['name']) ? $tool['name'] : ''}}" />
                      </div>
                      <p class="text-dark mb-0">{{ !empty($tool['name']) ? $tool['name'] : ''}}</p>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  @endif