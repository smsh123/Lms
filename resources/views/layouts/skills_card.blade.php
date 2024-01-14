  @if(!empty($skills))
    <div class="container mt-4" id="tools">
      <div class="card border-0">
        <div class="card-header bg-transparent border-0">
          <h3 class="font-22 font-weight-bold mb-0"><span class="text-theme-contrast pr-2">Skills</span>We Will gain</h3>
        </div>
        <div class="card-body">
          <ul class="list-no-style mx-0 px-0 d-flex justify-content-start flex-wrap">
            @foreach ($skills as $key => $skill)
              <li class="btn btn-light rounded-pill mb-2 mr-2 text-capitalize">{{ !empty($skill) ? $skill : ''}}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endif