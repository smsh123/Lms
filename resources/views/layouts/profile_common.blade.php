@php

  $isUserLoggedin = false;
  $isUserLoggedin = \Auth::user();
  if($isUserLoggedin){
    $user_details = getUserDetailsById($isUserLoggedin->_id);
  }
@endphp
@if ($isUserLoggedin && !empty($user_details))
  <div class="bg-white h-100 min-vh-100 sticky-top overflow-auto">
     <div class="card border-top-0 border-left-0 border-bottom-0 bg-transparent">
        <div class="card-body">
          <div class="icon-100 mx-auto my-3">
            <div class="ratio-image image_1-1 bg-transparent rounded-circle">
              <img src="{{ !empty($user_details['avatar_image']) ? $user_details['avatar_image'] : 'https://spiderimg1.safalta.com/assets/images/safalta.com/2020/02/05/profile-default_5e3a70b0d2b90.jpg' }}"  alt="username" onerror="this.src='https://spiderimg1.safalta.com/assets/images/safalta.com/2020/02/05/profile-default_5e3a70b0d2b90.jpg';" />
            </div>
          </div>
          <h3 class="font-22 font-weight-bold text-uppercase text-center">{{ !empty(\Auth::user()->name) ? \Auth::user()->name : 'Student' }}</h3>
          <ul class="profile_menu_list profile_sidebar mt-5 list-no-style p-0 mx-0">
           @if(!empty($user_details['user_type']) && $user_details['user_type'] == 'internal')
            <li class="py-2">
              <a  class="btn rounded-pill w-100 d-flex" href="/cms">
                 <div class="menu-icon align-self-center">
                    <div class="icon-24 text-theme-contrast"><i class="bi bi-microsoft font-22"></i></div>
                  </div>
                  <div class="flex-fill align-self-center px-3 font-22 text-left">Amin Panel</div>
              </a>
            </li>
            @endif
            <li class="py-2">
              <a  class="btn rounded-pill w-100 d-flex @if(!empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/profile/'.$user_details['_id']) active @endif" href="/profile/{{ !empty($user_details['_id']) ? $user_details['_id']  : '' }}">
                 <div class="menu-icon align-self-center">
                    <div class="icon-24 text-theme-contrast"><i class="bi bi-person-badge font-22"></i></div>
                  </div>
                  <div class="flex-fill align-self-center px-3 font-22 text-left">My Profile</div>
              </a>
            </li>
            <li class="py-2">
              <a  class="btn rounded-pill w-100 d-flex @if(!empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/courses/'.$user_details['_id']) active @endif" href="/courses/{{ !empty($user_details['_id']) ? $user_details['_id']  : '' }}">
                 <div class="menu-icon align-self-center">
                    <div class="icon-24 text-theme-contrast"><i class="bi bi-journals font-22"></i></div>
                  </div>
                  <div class="flex-fill align-self-center px-3 font-22 text-left">My Courses</div>
              </a>
            </li>
            <li class="py-2">
              <a  class="btn rounded-pill w-100 d-flex @if(!empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/orders/'.$user_details['_id']) active @endif" href="/orders/{{ !empty($user_details['_id']) ? $user_details['_id']  : '' }}">
                 <div class="menu-icon align-self-center">
                    <div class="icon-24 text-theme-contrast"><i class="bi bi-currency-rupee font-22"></i></div>
                  </div>
                  <div class="flex-fill align-self-center px-3 font-22 text-left">My Orders</div>
              </a>
            </li>
            <li class="py-2">
              <a  class="btn rounded-pill w-100 d-flex @if(!empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/reports/'.$user_details['_id']) active @endif" href="/reports/{{ !empty($user_details['_id']) ? $user_details['_id']  : '' }}">
                 <div class="menu-icon align-self-center">
                    <div class="icon-24 text-theme-contrast"><i class="bi bi-graph-up-arrow font-22"></i></div>
                  </div>
                  <div class="flex-fill align-self-center px-3 font-22 text-left">Reports</div>
              </a>
            </li>
             <li class="py-2">
              <a  class="btn rounded-pill w-100 d-flex" href="/logout">
                 <div class="menu-icon align-self-center">
                    <div class="icon-24 text-theme-contrast"><i class="bi bi-box-arrow-left font-22"></i></div>
                  </div>
                  <div class="flex-fill align-self-center px-3 font-22 text-left">Logout</div>
              </a>
            </li>
          </ul>
        </div>
      </div>
  </div>
@endif