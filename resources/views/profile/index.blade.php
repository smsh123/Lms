@extends('layouts.front')
@section('body')
  @include('layouts.global_header')
  <div class="min-vh-100">
    @include('layouts.profile_common')
    <div class="row no-gutters">
      <div class="col-12">
          @if(!empty($profile_details))
            <div class="card mw-768 mx-auto mb-3">
              <div class="card-body">
                <p class="card-text"><i class="bi bi-person mr-2 align-middle text-primary"></i>{{ !empty($profile_details['name']) ? $profile_details['name'] : 'NA'}}</p>
                <p class="card-text"><i class="bi bi-phone mr-2 align-middle text-primary"></i>{{ !empty($profile_details['mobile']) ? $profile_details['mobile'] : 'NA'}}</p>
                <p class="card-text"><i class="bi bi-envelope mr-2 align-middle text-primary"></i>{{ !empty($profile_details['email']) ? $profile_details['email'] : 'NA'}}</p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="/edit-profile/{{ !empty($profile_details['_id']) ? $profile_details['_id'] : 'NA' }}" class="card-link text-primary d-block w-100 profile_option_link"><i class="bi bi-pencil-square font-22 align-middle mr-2 text-primary"></i>Edit Profile</a></li>
                <li class="list-group-item"><a href="/support/{{ !empty($profile_details['_id']) ? $profile_details['_id'] : 'NA' }}" class="card-link text-primary d-block w-100 profile_option_link"><i class="bi bi-chat-left-quote font-22 align-middle mr-2 text-primary"></i>Support</a></li>
                <li class="list-group-item"><a href="/logout" class="card-link text-primary d-block w-100 profile_option_link"><i class="bi bi-box-arrow-left font-22 align-middle mr-2 text-primary"></i>Sign Out</a></li>
              </ul>
            </div>
          @endif
      </div>
    </div>
  </div>
@stop

