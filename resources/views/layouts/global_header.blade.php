@php

  $isUserLoggedin = false;
  $isUserLoggedin = \Auth::user();
  if($isUserLoggedin){
    $user_details = getUserDetailsById($isUserLoggedin->_id);
  }
  
  $menuItems = [
    [
        'label' => 'home',
        'url' => '/',
    ],
    [
        'label' => 'aryabhatt courses',
        'url' => '/course',
    ],
    [
        'label' => 'blogs',
        'url' => '/blogs',
    ],
    [
        'label' => 'success stories',
        'url' => '/success-stories',
    ]
  ];
  $MenuSlug = 'site-navigation';
  $menus = getMenuBySlug($MenuSlug);

@endphp

{{-- <div class="bg-theme-contrast py-3 px-3">
  <div class="container text-center text-white font-weight-bold">
    <p class="mb-0">
      <span class="brand-txt mx-2 align-middle">ARYABHATT Class</span>
      launches specialised courses for class 10th & 12th Exam. <a class="text-white align-middle px-3" href="#"> Know More <i class="bi bi-arrow-right mx-2"></i></a>
    </p>
  </div>
</div> --}}
<div class="gloabl-header border border-top-0 border-right-0 border-left-0" style="background-color: #fff;">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light p-0">
        <a class="navbar-brand" href="/">
          <img src="/assets/image/logo.png" class="brand-logo" alt="AryaBhat Classes" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            @if(!empty($menus))
              @foreach ($menus['items'] as $key => $menu )
                <li class="nav-item {{ !empty($menu['link']) && $menu['link'] == $_SERVER['REQUEST_URI'] ? 'active' : '' }}">
                  <a class="nav-link px-3 text-capitalize" href="{{ !empty($menu['link']) ? $menu['link'] : '#' }}">{{ !empty($menu['title']) ? $menu['title'] : '-' }}</a>
                </li>
                @if($key == 3)
                  @break;
                @endif
              @endforeach
              @if(count($menus['items']) > 4)
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    More
                  </a>
                  <div class="dropdown-menu">
                    @foreach ($menus['items'] as $key => $menu )
                      @if($key > 3)
                        <a class="dropdown-item text-capitalize" href="{{ !empty($menu['link']) ? $menu['link'] : '#' }}">{{ !empty($menu['title']) ? $menu['title'] : '-' }}</a>
                      @endif
                    @endforeach
                  </div>
                </li>
              @endif
            @endif
            </ul>
            <form class="form-inline my-2 my-lg-0 d-none d-md-block">
              <button class="btn bg-transparent text-dark mx-2 my-2 my-sm-0" type="submit"><i class="bi bi-search"></i></button>
              <a href="/course" class="btn btn-theme-contrast my-2 mx-2 my-sm-0" type="submit">Buy A Course</a>
              @if(!$isUserLoggedin)
                <a href="javascript:void(0)" class="btn bg-transparent text-theme-contrast my-2 my-sm-0" type="submit" onclick="openLoginWindow()">Login</a>
              @else
                <a href="javascript:void(0)" class="btn bg-transparent text-theme-contrast my-2 my-sm-0" type="submit" onclick="openProfileMenu()"><div class="icon-24 d-inline-block"><div class="ratio-image image_1-1 rounded-circle"><img src="{{ !empty(\Auth::user()->avatar_image) ? \Auth::user()->avatar_image : 'https://spiderimg1.safalta.com/assets/images/safalta.com/2020/02/05/profile-default_5e3a70b0d2b90.jpg' }}"  alt="username" onerror="this.src='https://spiderimg1.safalta.com/assets/images/safalta.com/2020/02/05/profile-default_5e3a70b0d2b90.jpg';" /></div></div></a>
              @endif
            </form>
        </div>
    </nav>
  </div>
</div>
  <div class="screen_fed"></div>
  @if(!$isUserLoggedin)
    <div id="login_menu" class="login_window side_menu mx-auto position-fixed bg-white zindex-fixed">
      <div class="card border-0">
        <div class="card-header bg-transparent text-right border-0">
          <a href="javascript:void(0)" title="close me" onclick="closeSideMenu()">
            <i class="bi bi-x-circle font-22 text-dark"></i>
          </a>
        </div>
        <div class="card-body">
          <div class="icon-250 mx-auto my-3">
            <div class="ratio-image image_16-9 bg-transparent">
              <img src="/assets/image/logo.png" alt="Aryabhatt Classes" />
            </div>
          </div>
          <h3 class="font-22 text-uppercase text-center"><span class="align-middle">Start</span> <span class="text-theme align-middle mx-1 font-weight-bold">Smart</span><span class="text-theme-contrast align-middle mx-1">Learning</span></h3>
          <form id="login_form" class="my-5 mx-auto" method="post" action="/login">
          @csrf
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Mobile/Email/Username" name="email"/>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Password" name="pwd" />
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary w-100 mw-450 mx-auto rounded-pill font-16"><span class="align-middle">Proceed</span><i class="bi bi-arrow-right-circle-fill align-middle mx-2"></i></button>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6 text-left"><a href="javascript:void(0)"  onclick="activateForm('#pw_recovery_form')">Forgot Password ?</a></div>
                <div class="col-6 text-right"><a href="javascript:void(0)"  onclick="activateForm('#register_form')">First Time User ?</a></div>
              </div>
            </div>
          </form>
          <form id="register_form" class="my-5 mx-auto"  style="display:none;" action="/register" method="post">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Your Name" id="reg_name" name="name" />
            </div>
            <div class="form-group">
              <input type="number" class="form-control" placeholder="Your Mobile" id="reg_mobile" name="mobile" />
            </div>
            <div class="form-group">
              <input type="email" class="form-control" placeholder="Your Email" id="reg_email" name="email" />
            </div>
            <div class="form-group">
              <input type="password" class="form-control" placeholder="Password" id="reg_pwd" name="pwd" />
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary w-100 mw-450 mx-auto rounded-pill font-16"><span class="align-middle">Register</span><i class="bi bi-arrow-right-circle-fill align-middle mx-2"></i></button>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6 text-left"><a href="javascript:void(0)" onclick="activateForm('#pw_recovery_form')">Forgot Password ?</a></div>
                <div class="col-6 text-right"><a href="javascript:void(0)" onclick="activateForm('#login_form')">Login</a></div>
              </div>
            </div>
          </form>
          <form id="pw_recovery_form" class="my-5 mx-auto" action="/reset_password_without_token" method="POST" style="display:none;">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Email / Mobile" name="email" />
            </div>
            <div class="form-group text-center">
              <button type="submit" class="btn btn-primary w-100 mw-450 mx-auto rounded-pill font-16"><span class="align-middle">Reset Password</span><i class="bi bi-arrow-right-circle-fill align-middle mx-2"></i></button>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-6 text-left"><a href="javascript:void(0)" onclick="activateForm('#register_form')">First Time User ?</a></div>
                <div class="col-6 text-right"><a href="javascript:void(0)" onclick="activateForm('#login_form')">Login</a></div>
              </div>
            </div>
          </form>
          <div class="py-3 text-center">
              <a href="{{ url('auth/google') }}" class="ml-2 btn rounded-pill btn-outline-primary">
                <i class="bi bi-google align-middle mr-3 font-22"></i><span class="align-middle font-16 ">Login With Google</span>
              </a> 
          </div>
        </div>
        <div class="card-footer login_window_footer border-0 theme-contrast-gradient-container position-relative pt-5 wave_border_top_white footer"></div>
      </div>
    </div>
  @else
    <div id="profile_menu" class="login_window side_menu mx-auto position-fixed bg-white zindex-fixed">
      <div class="card border-0">
        <div class="card-header bg-transparent text-right border-0">
          <a href="javascript:void(0)" title="close me" onclick="closeSideMenu()">
            <i class="bi bi-x-circle font-22 text-dark"></i>
          </a>
        </div>
        <div class="card-body">
          <div class="icon-100 mx-auto my-3">
            <div class="ratio-image image_1-1 bg-transparent rounded-circle">
              <img src="{{ !empty($user_details['avatar_image']) ? $user_details['avatar_image'] : 'https://spiderimg1.safalta.com/assets/images/safalta.com/2020/02/05/profile-default_5e3a70b0d2b90.jpg' }}"  alt="username" onerror="this.src='https://spiderimg1.safalta.com/assets/images/safalta.com/2020/02/05/profile-default_5e3a70b0d2b90.jpg';" />
            </div>
          </div>
          <h3 class="font-35 font-weight-bold text-uppercase text-center">{{ !empty(\Auth::user()->name) ? \Auth::user()->name : 'Student' }}</h3>
          <ul class="profile_menu_list mt-5 list-no-style p-0 mx-0">
           @if(!empty($user_details['user_type']) && $user_details['user_type'] == 'internal')
            <li class="py-3">
              <a  class="d-flex text-dark card-link font-22 justify-content-center" href="/cms">
                 <div class="menu-icon align-self-center">
                    <div class="icon-24 text-theme-contrast"><i class="bi bi-microsoft font-22"></i></div>
                  </div>
                  <div class="flex-fill align-self-center px-3">Amin Panel</div>
              </a>
            </li>
            @endif
            <li class="py-3">
              <a  class="d-flex text-dark card-link font-22 justify-content-center" href="/profile/{{ !empty($user_details['_id']) ? $user_details['_id']  : '' }}">
                 <div class="menu-icon align-self-center">
                    <div class="icon-24 text-theme-contrast"><i class="bi bi-person-badge font-22"></i></div>
                  </div>
                  <div class="flex-fill align-self-center px-3">My Profile</div>
              </a>
            </li>
            <li class="py-3">
              <a  class="d-flex text-dark card-link font-22 justify-content-center" href="/my-courses/{{ !empty($user_details['_id']) ? $user_details['_id']  : '' }}">
                 <div class="menu-icon align-self-center">
                    <div class="icon-24 text-theme-contrast"><i class="bi bi-journals font-22"></i></div>
                  </div>
                  <div class="flex-fill align-self-center px-3">My Courses</div>
              </a>
            </li>
            <li class="py-3">
              <a  class="d-flex text-dark card-link font-22 justify-content-center" href="/orders/{{ !empty($user_details['_id']) ? $user_details['_id']  : '' }}">
                 <div class="menu-icon align-self-center">
                    <div class="icon-24 text-theme-contrast"><i class="bi bi-currency-rupee font-22"></i></div>
                  </div>
                  <div class="flex-fill align-self-center px-3">My Orders</div>
              </a>
            </li>
            <li class="py-3">
              <a  class="d-flex text-dark card-link font-22 justify-content-center" href="/reports/{{ !empty($user_details['_id']) ? $user_details['_id']  : '' }}">
                 <div class="menu-icon align-self-center">
                    <div class="icon-24 text-theme-contrast"><i class="bi bi-graph-up-arrow font-22"></i></div>
                  </div>
                  <div class="flex-fill align-self-center px-3">Reports</div>
              </a>
            </li>
             <li class="py-3">
              <a  class="d-flex text-dark card-link font-22 justify-content-center" href="/logout">
                 <div class="menu-icon align-self-center">
                    <div class="icon-24 text-theme-contrast"><i class="bi bi-box-arrow-left font-22"></i></div>
                  </div>
                  <div class="flex-fill align-self-center px-3">Logout</div>
              </a>
            </li>
          </ul>
        </div>
        <div class="card-footer login_window_footer border-0 theme-contrast-gradient-container position-relative pt-5 wave_border_top_white footer"></div>
      </div>
    </div>
  @endif

@if (session('error'))
  <div class="alert alert-danger custom-alert font-weight-bold">
      {{ session('error') }}
  </div>
@elseif (session('msg'))
  <div class="alert alert-success custom-alert font-weight-bold">
      {{ session('msg') }}
  </div>
@elseif (session('msg_focus'))
  <div class="alert alert-warning alert-fixed alert-dismissible fade show" role="alert">
    {!! html_entity_decode(session('msg_focus')) !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
