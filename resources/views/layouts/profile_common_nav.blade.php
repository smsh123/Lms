@php

  $isUserLoggedin = false;
  $isUserLoggedin = \Auth::user();
  if($isUserLoggedin){
    $user_details = getUserDetailsById($isUserLoggedin->_id);
  }
@endphp
  @if ($isUserLoggedin && !empty($user_details))
    <div class="page_section_nav bg-white sticky-top mt-3 mb-1 border-0 overflow-auto" style="top:0px;">
      <ul class="nav nav-pills nav-fill flex-nowrap">
          <li class="nav-item text-nowrap">
            <a class="nav-link @if(!empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/profile/'.$user_details['_id']) active @endif" href="/profile/{{ !empty($user_details['_id']) ? $user_details['_id']  : '' }}">
              <div class="icon-24 mx-auto"><i class="bi bi-person-badge font-22"></i></div>
              <span>My Profile</span>
            </a>
          </li>
          <li class="nav-item text-nowrap">
            <a class="nav-link @if(!empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/my-courses/'.$user_details['_id']) active @endif" href="/my-courses/{{ !empty($user_details['_id']) ? $user_details['_id']  : '' }}" >
              <div class="icon-24 mx-auto"><i class="bi bi-journals font-22"></i></div>
              <span>My Courses</span>
            </a>
          </li>
          <li class="nav-item text-nowrap">
            <a class="nav-link @if(!empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/orders/'.$user_details['_id']) active @endif" href="/orders/{{ !empty($user_details['_id']) ? $user_details['_id']  : '' }}" >
              <div class="icon-24 mx-auto"><i class="bi bi-currency-rupee font-22"></i></div>
              <span>My Orders</span>
            </a>
          </li>
          <li class="nav-item text-nowrap">
            <a class="nav-link @if(!empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/reports/'.$user_details['_id']) active @endif" href="/reports/{{ !empty($user_details['_id']) ? $user_details['_id']  : '' }}" >
              <div class="icon-24 mx-auto"><i class="bi bi-graph-up-arrow font-22"></i></div>
              <span>Reports</span>
            </a>
          </li>
      </ul>
    </div>
  @endif