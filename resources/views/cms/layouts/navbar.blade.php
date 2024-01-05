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
        'page_group' => 'brand'
    ],
    [
        'label' => 'categories',
        'icon'=>'grid',
        'url' => '/cms/categories',
        'permission' => 'View Category',
        'page_group' => 'category'
    ],
    [
        'label' => 'courses',
        'icon'=>'book',
        'url' => '/cms/courses',
        'permission' => 'View Course',
        'page_group' => 'course'
    ],
    [
        'label' => 'blogs',
        'icon'=>'file-text',
        'url' => '/cms/blogs',
        'permission' => 'View Blog',
        'page_group' => 'blog'
    ],
    [
        'label' => 'users',
        'icon'=>'users',
        'url' => '/cms/users',
        'permission' => 'View User',
        'page_group' => 'user'
    ],
    [
        'label' => 'orders',
        'icon'=>'shopping-cart',
        'url' => '/cms/orders',
        'permission' => 'View Order',
        'page_group' => 'order'
    ],
    [
        'label' => 'subscriptions',
        'icon'=>'award',
        'url' => '/cms/subscriptions',
        'permission' => 'View Subscription',
        'page_group' => 'subscription'
    ],
    [
        'label' => 'scheduling',
        'icon'=>'calendar',
        'url' => '/cms/schedule',
        'permission' => 'View Scheduling',
        'page_group' => 'scheduling'
    ],
    [
        'label' => 'banners',
        'icon'=>'image',
        'url' => '/cms/banners',
        'permission' => 'View Banner',
        'page_group' => 'banner'
    ],
    [
        'label' => 'tools',
        'icon'=>'folder-plus',
        'url' => '/cms/tools',
        'permission' => 'View Tool',
        'page_group' => 'tool'
    ],
    [
        'label' => 'testimonials',
        'icon'=>'star',
        'url' => '/cms/testimonials',
        'permission' => 'View Testimonial',
        'page_group' => 'testimonial'
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
        'page_group' => 'lead'
    ],
    [
        'label' => 'menu',
        'icon'=>'menu',
        'url' => '/cms/menus',
        'permission' => 'View Menu',
        'page_group' => 'menu'
    ],
    [
        'label' => 'section',
        'icon'=>'codesandbox',
        'url' => '/cms/sections',
        'permission' => 'View Section',
        'page_group' => 'section'
    ],
    [
        'label' => 'content block',
        'icon'=>'file-text',
        'url' => '/cms/blocks',
        'permission' => 'View Content Block',
        'page_group' => 'block'
    ],
    [
        'label' => 'module',
        'icon'=>'airplay',
        'url' => '/cms/modules',
        'permission' => 'View Module',
        'page_group' => 'module'
    ],
    [
        'label' => 'FAQ',
        'icon'=>'message-square',
        'url' => '/cms/faq',
        'permission' => 'View FAQ',
        'page_group' => 'faq'
    ],
    [
        'label' => 'mapping',
        'icon'=>'columns',
        'url' => '/cms/mappings',
        'permission' => 'View Mapping',
        'page_group' => 'mapping'
    ],
    [
        'label' => 'role',
        'icon'=>'layout',
        'url' => '/cms/roles',
        'permission' => 'View Role',
        'page_group' => 'role'
    ],
    [
        'label' => 'permission',
        'icon'=>'layout',
        'url' => '/cms/permissions',
        'permission' => 'View Permission',
        'page_group' => 'permission'
    ],
    [
        'label' => 'pages',
        'icon'=>'layout',
        'url' => '/cms/pages',
        'permission' => 'View Page',
        'page_group' => 'page'
    ],
    [
        'label' => 'coupons',
        'icon'=>'tag',
        'url' => '/cms/coupons',
        'permission' => 'View Coupon',
        'page_group' => 'coupon'
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
            @php
                $required_permission = !empty($menus['permission']) ? $menus['permission'] : 'not_required' ; 
                $selected_page_group = !empty($menus['page_group']) ? $menus['page_group'] : 'dashboard';
            @endphp
            @if((!empty($isUserLoggedin->permissions) && in_array($required_permission,$isUserLoggedin->permissions)) || $required_permission == 'not_required')
                <li class="nav-item @if(!empty($menus['url']) && $menus['url'] == $_SERVER['REQUEST_URI']) active @elseif(!empty($page_group) && $page_group == $selected_page_group) active @endif">
                    <a class="nav-link @if(!empty($menus['url']) && $menus['url'] == $_SERVER['REQUEST_URI']) text-dark @elseif(!empty($page_group) && $page_group == $selected_page_group) text-dark @else text-primary @endif" href="{{ !empty($menus['url']) ? $menus['url'] : '#' }}">
                    <span data-feather="{{ !empty($menus['icon']) ? $menus['icon'] : '#' }}"></span>
                    {{ !empty($menus['label']) ? $menus['label'] : '#' }}
                    </a>
                </li>
            @endif
        @endforeach
        </ul>
      </div>
    </nav>