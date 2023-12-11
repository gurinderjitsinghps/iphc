<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
      <a href="{{ route('superadmin.dashboard') }}" class="d-flex align-items-center">
      <img src="/assets/images/logo.png" class="logo" alt="logo icon">
      <span>
        @auth
    Welcome, {{ auth('superadmin')->user()->name }}
@endauth
      </span>
      </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
      <li class="{{ request()->is('superadmin/dashboard') ? 'active' : '' }}">
        <a href="{{ route('superadmin.dashboard') }}" class="waves-effect">
          <span class="menu-box">
            <div class="menu-icon"> 
              <img src="/assets/images/icons/dashboard.svg">
            </div>
            <p class="menu-name mb-0">Dashboard</p>
          </span>
        </a>
      </li>
      <li class="{{ request()->is('superadmin/members*') ? 'active' : '' }}">
        <a href="{{ route('superadmin.members') }}" class="waves-effect">
          <span class="menu-box">
            <div class="menu-icon"> 
              <img src="/assets/images/icons/manage_accounts.svg">
            </div>
            <p class="menu-name mb-0">End User Management</p>
          </span>
        </a>
      </li>
      <li class="{{ request()->is('superadmin/administration_roles*') ? 'active' : '' }}">
        <a href="{{ route('superadmin.administration_roles') }}" class="waves-effect">
          <span class="menu-box">
            <div class="menu-icon"> 
              <img src="/assets/images/icons/shield_person.svg">
            </div>
            <p class="menu-name mb-0">Administration Role Management</p>
          </span>
        </a>
      </li>
      <li>
      <li class="{{ request()->is('superadmin/adverts') ? 'active' : '' }}">
        <a href="{{ route('superadmin.adverts') }}" class="waves-effect">
          <span class="menu-box">
            <div class="menu-icon"> 
              <img src="/assets/images/icons/sticky-notes.png">
            </div>
            <p class="menu-name mb-0">Advert Management</p>
          </span>
        </a>
      </li>
      <li class="{{ request()->is('superadmin/transactions*') ? 'active' : '' }}">
        <a href="{{ route('superadmin.transactions') }}" class="waves-effect">
          <span class="menu-box">
            <div class="menu-icon"> 
              <img src="/assets/images/icons/monitoring.svg">
            </div>
            <p class="menu-name mb-0">Transaction Monitoring</p>
          </span>
        </a>
      </li>
      <li class="{{ request()->is('superadmin/categories*') || request()->is('superadmin/business_categories*') || request()->is('superadmin/business_funding_categories*') ? 'active' : '' }}">
        <a href="{{ route('superadmin.categories') }}" class="waves-effect">
          <span class="menu-box">
            <div class="menu-icon"> 
              <img src="/assets/images/icons/category.svg">
            </div>
            <p class="menu-name mb-0">Categories</p>
          </span>
        </a>
      </li>
      <li class="{{ request()->is('superadmin/cms*') ? 'active' : '' }}">
        <a href="{{ route('superadmin.cms') }}" class="waves-effect">
          <span class="menu-box">
            <div class="menu-icon"> 
              <img src="/assets/images/icons/cms.png">
            </div>
            <p class="menu-name mb-0">CMS</p>
          </span>
        </a>
      </li>
      <li class="{{ request()->is('superadmin/reports_analytics') ? 'active' : '' }}">
        <a href="{{ route('superadmin.reports_analytics') }}" class="waves-effect">
          <span class="menu-box">
            <div class="menu-icon"> 
              <img src="/assets/images/icons/insert_chart.svg">
            </div>
            <p class="menu-name mb-0">Report & Analytics</p>
          </span>
        </a>
      </li>
      <li>
        <a href="#" class="waves-effect">
          <span class="menu-box">
            <div class="menu-icon"> 
              <img src="/assets/images/icons/quiz.svg">
            </div>
            <p class="menu-name mb-0">Support Management</p>
          </span>
        </a>
      </li>
      <li>
        <a href="#" class="waves-effect">
          <span class="menu-box">
            <div class="menu-icon"> 
              <img src="/assets/images/icons/settings.svg">
            </div>
            <p class="menu-name mb-0">Settings</p>
          </span>
        </a>
      </li>
    </ul>
    <div class="footer-menu">
      <a href="notification.html">
        <div class="menu-icon pl-2"> 
          <img src="/assets/images/icons/notifications.svg">
        </div>
      </a>
      <a href="#">
        <div class="menu-icon"> 
          <img src="/assets/images/icons/safe.svg">
        </div>
      </a>
       <span href="#" class="dropdown">
        <a style="cursor: pointer;" data-toggle="dropdown">
          <div class="menu-icon"> 
            <img src="/assets/images/icons/earth.svg">
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right cus-drop-menu-right2 cus-drop-menu-right3">
          <li class="dropdown-item"><a href=""><i class="flag-icon flag-icon-gb mr-2"></i> English</a></li>
          <li class="dropdown-item"><a href=""><i class="flag-icon flag-icon-fr mr-2"></i> French</a></li>
        </div>
      </span>
      <a href="login.html">
        <div class="menu-icon pr-0"> 
          <img src="/assets/images/icons/power_settings.svg">
        </div>
      </a>
    </div>
  </div>