<div class="card-header text-center">
    <a href="{{ route('shop.home.index') }}" class="h1">
        @if (core()->getConfigData('general.design.admin_logo.logo_image', core()->getCurrentChannelCode()))
            <img src="{{ \Illuminate\Support\Facades\Storage::url(core()->getConfigData('general.design.admin_logo.logo_image', core()->getCurrentChannelCode())) }}"
                alt="{{ config('app.name') }}" style="height: 40px; width: 110px;" />
        @else
            <img src="{{ asset('vendor/webkul/ui/assets/images/logo.png') }}" alt="{{ config('app.name') }}" />
        @endif
    </a>
</div>
