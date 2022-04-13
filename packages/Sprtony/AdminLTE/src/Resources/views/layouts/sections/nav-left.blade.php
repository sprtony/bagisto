<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('shop.home.index') }}" class="brand-link logo-switch">
        @if (core()->getConfigData('general.design.admin_logo.logo_image', core()->getCurrentChannelCode()))
            <img src="{{ \Illuminate\Support\Facades\Storage::url(core()->getConfigData('general.design.admin_logo.logo_image', core()->getCurrentChannelCode())) }}"
                alt="{{ config('app.name') }}" class="brand-image-xl" />
        @else
            <img src="{{ asset('vendor/webkul/ui/assets/images/logo.png') }}" alt="{{ config('app.name') }}"
                class="brand-image-xl" />
        @endif
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                @foreach ($menu->items as $menuItem)
                    @if (count($menuItem['children']))
                        <li class="nav-item {{ $menu->isActive($menuItem) ? 'menu-open' : '' }}">
                            <a class="nav-link {{ $menu->isActive($menuItem) ? 'active' : '' }}">
                                <i class="nav-icon {{ $menuItem['icon-class'] }}"></i>
                                <p>
                                    {{ trans($menuItem['name']) }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach ($menuItem['children'] as $children)
                                    <li class="nav-item">
                                        <a href="{{ route($children['route']) }}"
                                            class="nav-link {{ $menu->isActive($menuItem) ? 'active' : '' }}">
                                            <i
                                                class="nav-icon {{ $children['icon-class'] ?: $menuItem['icon-class'] }}"></i>
                                            <p>{{ trans($children['name']) }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route($menuItem['route']) }}"
                                class="nav-link {{ $menu->isActive($menuItem) ? 'active' : '' }}">
                                <i class="nav-icon {{ $menuItem['icon-class'] }}"></i>
                                <p>
                                    {{ trans($menuItem['name']) }}
                                </p>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
