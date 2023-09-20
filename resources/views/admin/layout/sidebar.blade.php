@php
  $menus = [
    'slider' => [
        'name' => 'Slider',
        'route' => route('admin.slider.index'),
        'icon' => 'mdi mdi-application menu-icon',
    ],
    'category' => [
        'name' => 'Danh Mục',
        'route' => route('admin.category.index'),
        'icon' => 'mdi mdi-collage menu-icon',
    ],
    'setting' => [
        'name' => 'Cài Đặt',
        'route' => route('admin.setting.index'),
        'icon' => 'mdi mdi-content-save-settings menu-icon',
    ],
    'user' => [
        'name' => 'User',
        'route' => route('admin.user.index'),
        'icon' => 'mdi mdi-account-multiple menu-icon',
    ],
  ];
 
@endphp
<nav class="sidebar sidebar-offcanvas bg-sidebar" id="sidebar">
  <ul class="nav">
    <li class="nav-item {{ request()->segment(2) == 'dashboard' ? 'active' : null }}">
      <a class="nav-link" href="../../index.html">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
  
    <li class="nav-item nav-category">Quản lý</li>
    @foreach ($menus as $k => $menu)
      <li class="nav-item {{ request()->segment(2) == $k ? 'active' : null }}">
        <a class="nav-link" href="{{ $menu['route'] }}">
          <i class="{{ $menu['icon'] }}"></i>
          <span class="menu-title">{{ $menu['name'] }}</span>
        </a>
      </li>
    @endforeach
  </ul>
  
</nav>
