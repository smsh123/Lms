 @php
    $brandDetails = getBrandBySlug('aryabhatt-classes');
    $footerCourses = getMenuBySlug('footer-courses');
    $footerStories = getMenuBySlug('footer-stories');
    $footerNav = getMenuBySlug('footer-nav');
    $isUserLoggedin = false;
    $isUserLoggedin = \Auth::user();
 @endphp
  @if(!empty($footerNav) && !empty($footerNav['items']))
    <div id="sticky-bottom" class="d-block d-md-none d-lg-none position-fixed footer-m-nav w-100 bg-white border border-muted shadow-sm pt-2 rounded-pill">
        <div class="d-flex justify-content-around align-items-stretch flex-nowrap">
          @foreach ($footerNav['items'] as $key => $item)
            <div class="align-self-start text-center pb-2 flex-fill">
              <a class="card-link d-block {{ !empty($item['link']) && $item['link'] == $_SERVER['REQUEST_URI'] ? 'text-dark' : 'text-theme-contrast' }}" href="{{!empty($item['link']) ? $item['link'] : '' }}">
                <div class="icon-24 mx-auto mb-2">
                  <i class="{{!empty($item['icon']) ? $item['icon'] : '' }} font-22"></i>
                </div>
                <div class="font-14">{{!empty($item['title']) ? $item['title'] : '' }}</div>
              </a>
            </div>
            @if($key == 2) @break; @endif
          @endforeach
          @if(!$isUserLoggedin)
            <div class="align-self-start text-center pb-2 flex-fill">
              <a class="text-theme-contrast card-link d-block" href="javascript:void(0)" onclick="openLoginWindow()">
                <div class="icon-24 mx-auto mb-2">
                  <i class="bi bi-person font-22"></i>
                </div>
                <div class="font-14">Login</div>
              </a>
            </div>
          @else
            <div class="align-self-start text-center pb-2 flex-fill">
              <a class="text-theme-contrast card-link d-block" href="javascript:void(0)" onclick="openProfileMenu()">
                <div class="icon-26 mx-auto mb-2"><div class="ratio-image image_1-1 rounded-circle"><img src="{{ !empty(\Auth::user()->avatar_image) ? \Auth::user()->avatar_image : 'https://spiderimg1.safalta.com/assets/images/safalta.com/2020/02/05/profile-default_5e3a70b0d2b90.jpg' }}"  alt="username" onerror="this.src='https://spiderimg1.safalta.com/assets/images/safalta.com/2020/02/05/profile-default_5e3a70b0d2b90.jpg';" /></div></div>
                <div class="font-14">{{ !empty(\Auth::user()->name) ? \Auth::user()->name : 'User' }}</div>
              </a>
            </div>
          @endif
        </div>
    </div>
  @endif
 
 <div class="bg-theme-contrast py-5 text-white position-relative">
  <div class="container">
  @if(!empty($brandDetails))
    <div class="row">
      <div class="col-12">
        <div class="icon-250 mx-auto mx-md-0">
            <div class="ratio-image image_16-9 bg-transparent">
              <a class="navbar-brand" href="#">
                <img src="{{ !empty($brandDetails['logo']) ? $brandDetails['logo'] : '/assets/image/logo-light.png' }}" class="brand-logo" alt="AryaBhat Classes" />
              </a>
            </div>
        </div>
      </div>
    </div>
  @endif
    <div class="d-flex row justify-content-between">
      @if(!empty($brandDetails))
        <div class="col-12 col-lg-4 text-center text-md-left text-lg-left">
          <h3 class="font-22">{{ !empty($brandDetails['name']) ? $brandDetails['name'] : 'Brand Name' }}</h3>
          <p>{{ !empty($brandDetails['address']) ? $brandDetails['address'] : 'Brand Address' }}</p>
          <p><a href="tel:{{ !empty($brandDetails['phone']) ? '+91'.$brandDetails['phone'] : '-' }}" class="card-link text-white">{{ !empty($brandDetails['phone']) ? '+91 '.$brandDetails['phone'] : '-' }}</a></p>
          <p><a href="mailto:{{ !empty($brandDetails['email']) ? $brandDetails['email'] : '-' }}" class="text-white">{{ !empty($brandDetails['email']) ? $brandDetails['email'] : '-' }}</a>
          <ul class="d-flex justify-content-center justify-content-md-start align-items-stretch my-3 mx-0 p-0 list-no-style">
            @if(!empty($brandDetails['facebook']) )
              <li class="p-1 align-self-center card-link">
                <a href="{{ $brandDetails['facebook'] }}" class="text-white">
                  <i class="bi bi-facebook font-32"></i>
                </a>
              </li>
            @endif
            @if(!empty($brandDetails['twitter']) )
              <li class="p-1 align-self-center card-link">
                <a href="{{ $brandDetails['twitter'] }}" class="text-white">
                  <i class="bi bi-twitter-x font-32"></i>
                </a>
              </li>
            @endif
            @if(!empty($brandDetails['youtube']) )
              <li class="p-1 align-self-center card-link">
                <a href="{{ $brandDetails['youtube'] }}" class="text-white">
                  <i class="bi bi-youtube font-32"></i>
                </a>
              </li>
            @endif
            @if(!empty($brandDetails['instagram']) )
              <li class="p-1 align-self-center card-link">
                <a href="{{ $brandDetails['instagram'] }}" class="text-white">
                  <i class="bi bi-instagram font-32"></i>
                </a>
              </li>
            @endif
            @if(!empty($brandDetails['linkedin']) )
              <li class="p-1 align-self-center card-link">
                <a href="{{ $brandDetails['linkedin'] }}" class="text-white">
                  <i class="bi bi-linkedin font-32"></i>
                </a>
              </li>
            @endif
          </ul>
        </div>
      @endif
      @if(!empty($footerCourses) && !empty($footerCourses['items']))
        <div class="col-12 col-lg-4 d-none d-md-block">
          <h3 class="font-16 font-weight-bold">{{ !empty($footerCourses['name']) ? $footerCourses['name'] : ''}}</h3>
          <ul class="list-no-style p-0 m-0">
            @foreach ($footerCourses['items'] as $key => $item )
              <li class="text-capitalize"><a href="{{ !empty($item['link']) ? $item['link'] : '' }}" class="text-white py-2 card-link d-block">{{ !empty($item['title']) ? $item['title'] : '' }}</a></li>
            @endforeach
          </ul>
        </div>
      @endif
      @if(!empty($footerStories) && !empty($footerStories['items']))
        <div class="col-12 col-lg-4 d-none d-md-block">
          <h3 class="font-16 font-weight-bold">{{ !empty($footerStories['name']) ? $footerStories['name'] : ''}}</h3>
          <ul class="list-no-style p-0 m-0">
            @foreach ($footerStories['items'] as $key => $item )
              <li class="text-capitalize"><a href="{{ !empty($item['link']) ? $item['link'] : '' }}" class="text-white py-2 card-link d-block">{{ !empty($item['title']) ? $item['title'] : '' }}</a></li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>
  </div>
 </div>