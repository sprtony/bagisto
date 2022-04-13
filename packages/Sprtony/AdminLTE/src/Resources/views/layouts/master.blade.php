<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <title>@yield('page_title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if ($favicon = core()->getConfigData('general.design.admin_logo.favicon', core()->getCurrentChannelCode()))
        <link rel="icon" sizes="16x16" href="{{ \Illuminate\Support\Facades\Storage::url($favicon) }}" />
    @else
        <link rel="icon" sizes="16x16" href="{{ asset('vendor/webkul/ui/assets/images/favicon.ico') }}" />
    @endif

    <link rel="stylesheet" href="{{ asset('admin-themes/adminLTE/assets/css/admin.css') }}">

    @yield('head')

    @stack('css')

    {!! view_render_event('bagisto.admin.layout.head') !!}

</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
    <div id="app" class="wrapper">

        <flash-wrapper ref='flashes'></flash-wrapper>

        {!! view_render_event('bagisto.admin.layout.nav-top.before') !!}
        @include ('admin::layouts.sections.nav-top')
        {!! view_render_event('bagisto.admin.layout.nav-top.after') !!}


        {!! view_render_event('bagisto.admin.layout.nav-left.before') !!}
        @include ('admin::layouts.sections.nav-left')
        {!! view_render_event('bagisto.admin.layout.nav-left.after') !!}


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            {!! view_render_event('bagisto.admin.layout.content.before') !!}
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">
                                @yield('header')
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            @yield('actions')
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        {!! view_render_event('bagisto.admin.layout.content.after') !!}

        @include('admin::layouts.sections.footer')
    </div>

    <script>
        window.flashMessages = [];
        @foreach (['success', 'warning', 'error', 'info'] as $key)
            @if ($value = session($key))
                window.flashMessages.push({'type': 'alert-{{ $key }}', 'message': "{{ $value }}" });
            @endif
        @endforeach

        window.serverErrors = [];
        @if (isset($errors))
            @if (count($errors))
                window.serverErrors = @json($errors->getMessages());
            @endif
        @endif
    </script>

    <script src="{{ asset('admin-themes/adminLTE/assets/js/admin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>
    @stack('scripts')
    {!! view_render_event('bagisto.admin.layout.body.after') !!}

    <div class="modal-overlay"></div>
</body>

</html>
