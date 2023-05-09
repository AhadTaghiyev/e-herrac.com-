<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.home')}}" class="brand-link">
      <img src="{{ asset('assets/admin/img/admin-logo-white.png') }}" alt="{{ config('app.name') }}" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('admin.home')}}" class="nav-link @if(request()->is('*admin')){{'active'}}@endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if(auth()->user()->can('page-list') || auth()->user()->can('page-create') || auth()->user()->can('page-edit') || auth()->user()->can('page-delete'))
                    <li class="nav-item">
                        <a href="{{route('admin.pages.index')}}" class="nav-link @if(request()->is('*admin/pages*')){{'active'}}@endif">
                            <i class="nav-icon fas fa-file"></i>
                            <p>Pages</p>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('advertisement-list') || auth()->user()->can('advertisement-create') || auth()->user()->can('advertisement-edit') || auth()->user()->can('advertisement-delete'))
                    <li class="nav-item">
                        <a href="{{route('admin.advertisements.index')}}" class="nav-link @if(request()->is('*admin/advertisements*')){{'active'}}@endif">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>Advertisements</p>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('auction-list') || auth()->user()->can('auction-create') || auth()->user()->can('auction-edit') || auth()->user()->can('auction-delete'))
                    <li class="nav-item">
                        <a href="{{route('admin.auctions.index')}}" class="nav-link @if(request()->is('*admin/auctions*')){{'active'}}@endif">
                            <i class="nav-icon fas fa-gavel"></i>
                            <p>Auctions</p>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('category-list') || auth()->user()->can('category-create') || auth()->user()->can('category-edit') || auth()->user()->can('category-delete'))
                    <li class="nav-item">
                        <a href="{{route('admin.categories.index')}}" class="nav-link @if(request()->is('*admin/categories*')){{'active'}}@endif">
                            <i class="nav-icon fas fa-list"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('region-list') || auth()->user()->can('region-create') || auth()->user()->can('region-edit') || auth()->user()->can('region-delete'))
                    <li class="nav-item">
                        <a href="{{route('admin.regions.index')}}" class="nav-link @if(request()->is('*admin/regions*')){{'active'}}@endif">
                            <i class="nav-icon fas fa-map-marker"></i>
                            <p>Regions</p>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('slide-list') || auth()->user()->can('slide-create') || auth()->user()->can('slide-edit') || auth()->user()->can('slide-delete'))
                    <li class="nav-item">
                        <a href="{{route('admin.slides.index')}}" class="nav-link @if(request()->is('*admin/slides*')){{'active'}}@endif">
                            <i class="nav-icon fas fa-sliders-h"></i>
                            <p>Slides</p>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('menu-list') || auth()->user()->can('menu-create') || auth()->user()->can('menu-edit') || auth()->user()->can('menu-delete'))
                    <li class="nav-item">
                        <a href="{{route('admin.menus.index')}}" class="nav-link @if(request()->is('*admin/menus*')){{'active'}}@endif">
                            <i class="nav-icon fas fa-bars"></i>
                            <p>Menus</p>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('role-list') || auth()->user()->can('role-create') || auth()->user()->can('role-edit') || auth()->user()->can('role-delete'))
                    <li class="nav-item">
                        <a href="{{route('admin.roles.index')}}" class="nav-link @if(request()->is('*admin/roles*')){{'active'}}@endif">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('permission-list') || auth()->user()->can('permission-create') || auth()->user()->can('permission-edit') || auth()->user()->can('permission-delete'))
                    <li class="nav-item">
                        <a href="{{route('admin.permissions.index')}}" class="nav-link @if(request()->is('*admin/permissions*')){{'active'}}@endif">
                            <i class="nav-icon fas fa-shield-alt"></i>
                            <p>Permissions</p>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->can('user-list') || auth()->user()->can('user-create') || auth()->user()->can('user-edit') || auth()->user()->can('user-delete'))
                    <li class="nav-item">
                        <a href="{{route('admin.users.index')}}" class="nav-link @if(request()->is('*admin/users*')){{'active'}}@endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
