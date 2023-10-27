@php
  $menuItems = [
    [
        'label' => 'dashboard',
        'icon'=>'home',
        'url' => '/cms',
    ],
    [
        'label' => 'courses',
        'icon'=>'book',
        'url' => '/cms/courses',
    ],
    [
        'label' => 'blogs',
        'icon'=>'file-text',
        'url' => '/cms/blogs',
    ],
    [
        'label' => 'users',
        'icon'=>'users',
        'url' => '/cms/users',
    ],
    [
        'label' => 'orders',
        'icon'=>'shopping-cart',
        'url' => '/cms/orders',
    ],
    [
        'label' => 'subscriptions',
        'icon'=>'award',
        'url' => '/cms/subscriptions',
    ],
    [
        'label' => 'subscriptions',
        'icon'=>'calendar',
        'url' => '/cms/schedule',
    ],
    [
        'label' => 'banners',
        'icon'=>'image',
        'url' => '/cms/banners',
    ],
    [
        'label' => 'testimonials',
        'icon'=>'star',
        'url' => '/cms/testimonials',
    ],
    [
        'label' => 'file upload',
        'icon'=>'upload-cloud',
        'url' => '/cms/upload',
    ],
    [
        'label' => 'leads',
        'icon'=>'package',
        'url' => '/cms/leads',
    ],
    [
        'label' => 'menu',
        'icon'=>'package',
        'url' => '/cms/menus',
    ],
    [
        'label' => 'logout',
        'icon'=>'log-out',
        'url' => '/logout',
    ]
  ];
@endphp


    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column text-capitalize">
        @foreach ( $menuItems as $key => $menus)
          <li class="nav-item {{ !empty($menus['url']) && $menus['url'] == $_SERVER['REQUEST_URI'] ? 'active' : '' }}">
            <a class="nav-link {{ !empty($menus['url']) && $menus['url'] == $_SERVER['REQUEST_URI'] ? 'text-dark' : 'text-primary' }}" href="{{ !empty($menus['url']) ? $menus['url'] : '#' }}">
              <span class="{{ !empty($menus['url']) && $menus['url'] == $_SERVER['REQUEST_URI'] ? 'text-dark' : 'text-primary' }}" data-feather="{{ !empty($menus['icon']) ? $menus['icon'] : '#' }}"></span>
              {{ !empty($menus['label']) ? $menus['label'] : '#' }}
            </a>
          </li>
        @endforeach
        </ul>
      </div>
    </nav>