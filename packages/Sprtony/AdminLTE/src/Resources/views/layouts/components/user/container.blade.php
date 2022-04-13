<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="{{ asset('admin-themes/adminLTE/assets/images/user-default.png') }}"
            class="user-image img-circle elevation-2" alt="User Image">

        <span class="d-none d-md-inline">
            {{ auth()->guard('admin')->user()->name }}
        </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-primary">
            <img src="{{ asset('admin-themes/adminLTE/assets/images/user-default.png') }}"
                class="img-circle elevation-2" alt="User Image">

            <p>
                {{ auth()->guard('admin')->user()->name }}
                <small> {{ auth()->guard('admin')->user()->role['name'] }}</small>
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <div class="row">
                <div class="col-6 text-center">
                    <a href="{{ route('shop.home.index') }}"
                        target="_blank">{{ __('admin::app.layouts.visit-shop') }}</a>
                </div>
            </div>
            <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <a href="{{ route('admin.account.edit') }}"
                class="btn btn-default btn-flat">{{ __('admin::app.layouts.my-account') }}</a>
            <a href="{{ route('admin.session.destroy') }}"
                class="btn btn-default btn-flat float-right">{{ __('admin::app.layouts.logout') }}</a>
        </li>
    </ul>
</li>
