<!-- Notifications Dropdown Menu -->
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        <span class="badge badge-warning navbar-badge">15</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">15 Notifications</span>
        <div class="dropdown-divider"></div>
        @include('admin::layouts.components.notifications.notification')
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
    </div>
</li>
