@php
  $menuItems = [
    [
        'label' => 'dashboard',
        'icon'=>'home',
        'url' => '/cms',
    ],
    [
        'label' => 'brand',
        'icon'=>'settings',
        'url' => '/cms/brands',
        'permission' => 'View Brand',
    ],
    [
        'label' => 'categories',
        'icon'=>'grid',
        'url' => '/cms/categories',
        'permission' => 'View Category',
    ],
    [
        'label' => 'courses',
        'icon'=>'book',
        'url' => '/cms/courses',
        'permission' => 'View Course',
    ],
    [
        'label' => 'blogs',
        'icon'=>'file-text',
        'url' => '/cms/blogs',
        'permission' => 'View Blog',
    ],
    [
        'label' => 'users',
        'icon'=>'users',
        'url' => '/cms/users',
        'permission' => 'View User',
    ],
    [
        'label' => 'orders',
        'icon'=>'shopping-cart',
        'url' => '/cms/orders',
        'permission' => 'View Order',
    ],
    [
        'label' => 'subscriptions',
        'icon'=>'award',
        'url' => '/cms/subscriptions',
        'permission' => 'View Subscription',
    ],
    [
        'label' => 'scheduling',
        'icon'=>'calendar',
        'url' => '/cms/schedule',
        'permission' => 'View Scheduling',
    ],
    [
        'label' => 'banners',
        'icon'=>'image',
        'url' => '/cms/banners',
        'permission' => 'View Banner',
    ],
    [
        'label' => 'tools',
        'icon'=>'folder-plus',
        'url' => '/cms/tools',
        'permission' => 'View Tool',
    ],
    [
        'label' => 'testimonials',
        'icon'=>'star',
        'url' => '/cms/testimonials',
        'permission' => 'View Testimonial',
    ],
    [
        'label' => 'file upload',
        'icon'=>'upload-cloud',
        'url' => '/cms/upload',
        'permission' => '',
    ],
    [
        'label' => 'leads',
        'icon'=>'package',
        'url' => '/cms/leads',
        'permission' => 'View Lead',
    ],
    [
        'label' => 'menu',
        'icon'=>'menu',
        'url' => '/cms/menus',
        'permission' => 'View Menu',
    ],
    [
        'label' => 'section',
        'icon'=>'codesandbox',
        'url' => '/cms/sections',
        'permission' => 'View Section',
    ],
    [
        'label' => 'content block',
        'icon'=>'file-text',
        'url' => '/cms/blocks',
        'permission' => 'View Content Block',
    ],
    [
        'label' => 'module',
        'icon'=>'airplay',
        'url' => '/cms/modules',
        'permission' => 'View Module',
    ],
    [
        'label' => 'FAQ',
        'icon'=>'message-square',
        'url' => '/cms/faq',
        'permission' => 'View FAQ',
    ],
    [
        'label' => 'mapping',
        'icon'=>'columns',
        'url' => '/cms/mappings',
        'permission' => 'View Mapping',
    ],
    [
        'label' => 'role',
        'icon'=>'layout',
        'url' => '/cms/roles',
        'permission' => 'View Role',
    ],
    [
        'label' => 'permission',
        'icon'=>'layout',
        'url' => '/cms/permissions',
        'permission' => 'View Permission',
    ],
    [
        'label' => 'pages',
        'icon'=>'layout',
        'url' => '/cms/pages',
        'permission' => 'View Page',
    ],
    [
        'label' => 'coupons',
        'icon'=>'tag',
        'url' => '/cms/coupons',
        'permission' => 'View Coupon',
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