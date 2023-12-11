<header class="topbar-nav">
    <nav class="navbar navbar-expand">
      <ul class="navbar-nav mr-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link toggle-menu pt-2" href="javascript:void();">
          <i class="icon-menu menu-icon"></i>
          </a>
        </li>
        <li class="nav-item">
          <h4 class="page-title mb-0 d-flex align-items-center">@yield('title')</h4>
        </li>
      </ul>
      <ul class="navbar-nav align-items-center right-nav-link">
        <li class="nav-item dropdown-lg position-relative">
          <div class="search-box">
            <input type="text" class="search-bar form-control" placeholder="Search"><i class="ti-search"></i>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
          <span class="user-profile"><i class="flag-icon flag-icon-gb"></i> Languages</span>
          </a>
          <ul style="right: inherit;" class="dropdown-menu dropdown-menu-right cus-drop-menu-right2 cus-drop-menu-right3">
            <div class="position-relative">
              <span class="dropdown-menu-arrow"></span>
            </div>
            <li class="dropdown-item"><a href=""><i class="flag-icon flag-icon-gb mr-2"></i> English</a></li>
            <li class="dropdown-item"><a href=""><i class="flag-icon flag-icon-fr mr-2"></i> French</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
          <span class="user-profile">
            @if(auth('superadmin')->user()->profile_image)
            <img src="/storage/{{auth('superadmin')->user()->profile_image}}" alt="" class="rounded-circle me-4">
            @else
            <img src="/assets/images/avatars/avatar.svg" class="img-circle" alt="user avatar" />
            @endif
            @auth
            {{ auth('superadmin')->user()->name }}
          @endauth
            
          </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-right cus-drop-menu-right2 cus-drop-menu-right3">
            <div class="position-relative">
              <span class="dropdown-menu-arrow"></span>
            </div>
            <li class="dropdown-item"><a  href="{{ route('superadmin.profile') }}"><span class="zmdi zmdi-account-circle"></span> Profile</a></li>
            <li class="dropdown-item"><a  href="{{ route('superadmin.profile.changePassword') }}"><span class="zmdi zmdi-key"></span> Change Password</a></li>
            {{-- <li class="dropdown-item"><a  href="notification-setting.html"><span class="zmdi zmdi-notifications-none"></span> Notification Settings</a></li> --}}
            <li class="dropdown-item">
              <form method="post" action="{{ route('superadmin.logout') }}">
                @csrf
                <button type="submit" class="a"><span class="zmdi zmdi-long-arrow-right"></span> Logout</button>
              </form>
             
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>