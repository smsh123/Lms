  @if(!empty($modules))
    <div class="container mt-4" id="modules">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent border-0">
          <div class="row">
            <div class="col-12 col-md-8 text-lg-left text-center"><h3 class="font-22 font-weight-bold mb-3 mb-md-0"><span class="text-theme-contrast pr-2">Modules</span>We Will Learn</h3></div>
            <div class="col-12 col-md-4 text-lg-right text-center">
              @if(!empty($CourseDescription['brochure']))
                <a href="{{ !empty($CourseDescription['brochure']) ? $CourseDescription['brochure'] : ''}}" target="_blank" class="btn btn-theme-contrast text-nowrap"><i class="bi bi-file-earmark-arrow-down mr-2"></i>Download Syllabus</a>
              @endif
            </div>
          </div>
          
        </div>
        <div class="card-body px-2">
          <div class="row">
            <div class="col-md-3 d-none d-md-block">
              {{-- <div class="nav flex-column nav-pills border h-100" id="v-pills-tab" role="tablist" aria-orientation="vertical"> --}}
              <div class="list-group h-100 theme-tav-container" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @foreach ($modules as $key => $module)
                  {{-- <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="v-pills-home-tab_{{ $key }}" data-toggle="pill" data-target="#tab_content_{{ $key }}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">{{ !empty($module['name']) ? $module['name'] : ''}}</button> --}}
                    <a href="#" class="list-group-item list-group-item-action {{ $key == 0 ? 'active' : '' }}" id="v-pills-home-tab_{{ $key }}" data-toggle="pill" data-target="#tab_content_{{ $key }}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                      <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ !empty($module['name']) ? $module['name'] : ''}}</h5>
                      </div>
                      <small>By Facutly Name</small>
                    </a>
                @endforeach
              </div>
              {{-- </div> --}}
            </div>
            <div class="col-md-9 px-2 px-lg-1">
              <div class="tab-content module-container" id="v-pills-tabContent">
                @foreach ($modules as $key => $module)
                  <div class="tab-pane px-0 fade module-header {{ $key == 0 ? 'show active' : '' }}" id="tab_content_{{ $key }}" role="tabpanel" aria-labelledby="v-pills-home-tab_{{ $key }}">
                    @if(!empty($module) && !empty($module['items']))
                      <div class="card">
                        <div class="card-header bg-theme-contrast text-white font-weight-bold">
                          @php
                            $index = $key+1;
                          @endphp
                          <p class="m-0">{{ !empty($module['name']) ? '('.$index.') '.$module['name'] : '' }}</p>
                        </div>
                        <div class="card-body px-1">
                        @if(!empty($module['items']))
                          <ul class="list-group list-group-flush">
                            @foreach ($module['items'] as $submodule)
                              <li class="list-group-item px-1">
                                <div class="d-flex flex-nowrap justify-content-around align-items-stretch row">
                                  <div class="flex-fill align-self-center col-10 font-12">{{ !empty($submodule['title']) ? $submodule['title'] : '' }}</div>
                                  <div class="flex-fill align-self-center col-2 text-center font-12"><span class="text-muted">{{ !empty($submodule['duration']) ? $submodule['duration'].' (Hrs)' : '' }}</span></div>
                                </div>
                                
                              </li>
                            @endforeach
                          </ul>
                        @else
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item px-1">
                              <div class="d-flex flex-nowrap justify-content-around align-items-stretch row">
                                <div class="flex-fill align-self-center col-12 font-12">{{ !empty($module['name']) ? '('.$index.') '.$module['name'] : '' }}</div>
                              </div>
                            </li>
                          </ul>
                        @endif
                        </div>
                      </div>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif