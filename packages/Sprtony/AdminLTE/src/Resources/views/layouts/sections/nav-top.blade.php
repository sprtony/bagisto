<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        @include('admin::layouts.components.tabs.container')

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        @include('admin::layouts.components.messages.container')
        @include('admin::layouts.components.notifications.container')
        @include('admin::layouts.components.user.container')


    </ul>
</nav>
<!-- /.navbar -->
