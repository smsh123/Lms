@php

  $isUserLoggedin = false;
  $isUserLoggedin = \Auth::user();
  if($isUserLoggedin){
    $user_details = getUserDetailsById($isUserLoggedin->_id);
  }
@endphp
@if ($isUserLoggedin && !empty($user_details))
  <div class="main-banner ratio-image image_1600-400 position-relative">
    <img src="{{ !empty($user_details['cover_image']) ? $user_details['cover_image'] : '/assets/image/main_banner.jpeg' }}" alt="main-banner" />
  </div>
  <div class="w-100">
     <div class="card shadow-sm border-0 border-radius-10 mb-3 mw-768 w-100 mx-auto profile_info_card">
        <div class="card-body pb-0 px-1">
          <div class="icon-100 mx-auto mb-3 profile_info_image">
            <div class="ratio-image image_1-1 bg-transparent rounded-circle">
              <img src="{{ !empty($user_details['avatar_image']) ? $user_details['avatar_image'] : 'https://spiderimg1.safalta.com/assets/images/safalta.com/2020/02/05/profile-default_5e3a70b0d2b90.jpg' }}"  alt="username" onerror="this.src='https://spiderimg1.safalta.com/assets/images/safalta.com/2020/02/05/profile-default_5e3a70b0d2b90.jpg';" />
            </div>
          </div>
          <h3 class="font-22 font-weight-bold text-uppercase text-center mb-5">{{ !empty(\Auth::user()->name) ? \Auth::user()->name : 'Student' }}</h3>
          @include('layouts.profile_common_nav')
        </div>
      </div>
  </div>
@endif