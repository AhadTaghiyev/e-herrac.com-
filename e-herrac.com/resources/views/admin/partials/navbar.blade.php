<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="{{route('home')}}" target="_blank"><i class="fas fa-desktop "></i> Visit Site</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="{{ auth()->user()->getFirstMediaUrl('photo') }}" class="user-image img-circle elevation-2" alt="">
          <span class="d-none d-md-inline">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            <img src="{{ auth()->user()->getFirstMediaUrl('photo') }}" class="img-circle elevation-2" alt="User Image">
            <p>
                {{auth()->user()->first_name}} {{auth()->user()->last_name}}
                <small>{{auth()->user()->roles()->first()->name}}</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="{{route('admin.profile')}}" class="btn btn-default btn-flat"><i class="fa fa-fw fa-user"></i> Profile</a>
            <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right"><i class="fa fa-fw fa-power-off"></i> Logout</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
