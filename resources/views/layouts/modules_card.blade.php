  @if(!empty($modules))
    <div class="container">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-transparent border-0">
          <h3 class="font-22 font-weight-bold mb-0"><span class="text-theme-contrast pr-2">Modules</span>We Will Learn</h3>
        </div>
        <div class="card-body">
          <div class="row no-gutters">
            <div class="col-md-3 d-none d-md-block">
              <div class="nav flex-column nav-pills border h-100" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @foreach ($modules as $key => $module)
                  <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="v-pills-home-tab_{{ $key }}" data-toggle="pill" data-target="#tab_content_{{ $key }}" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">{{ !empty($module['name']) ? $module['name'] : ''}}</button>
                @endforeach
              </div>
            </div>
            <div class="col-md-9">
              <div class="tab-content" id="v-pills-tabContent">
                @foreach ($modules as $key => $module)
                  <div class="tab-pane fade module-header {{ $key == 0 ? 'show active' : '' }}" id="tab_content_{{ $key }}" role="tabpanel" aria-labelledby="v-pills-home-tab_{{ $key }}">
                    @if(!empty($module) && !empty($module['items']))
                      <div class="card">
                        <div class="card-header bg-theme-contrast text-white font-weight-bold d-md-none d-block">
                          @php
                            $index = $key+1;
                          @endphp
                          <p class="m-0">{{ !empty($module['name']) ? '('.$index.') '.$module['name'] : '' }}</p>
                        </div>
                        <div class="card-body">
                          <ul class="list-group list-group-flush">
                            @foreach ($module['items'] as $submodule)
                              <li class="list-group-item">
                                <div class="d-flex flex-nowrap justify-content-around align-items-stretch row">
                                  <div class="flex-fill align-self-center col-10">{{ !empty($submodule['title']) ? $submodule['title'] : '' }}</div>
                                  <div class="flex-fill align-self-center col-12 text-center"><span class="text-muted">{{ !empty($submodule['duration']) ? $submodule['duration'].' (Hrs)' : '' }}</span></div>
                                </div>
                                
                              </li>
                            @endforeach
                          </ul>
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