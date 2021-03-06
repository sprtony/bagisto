     <!DOCTYPE html>
     <html lang="{{ config('app.locale') }}">

     <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>@yield('page_title')</title>

         <meta name="csrf-token" content="{{ csrf_token() }}">

         @if ($favicon = core()->getConfigData('general.design.admin_logo.favicon'))
             <link rel="icon" sizes="16x16" href="{{ \Illuminate\Support\Facades\Storage::url($favicon) }}" />
         @else
             <link rel="icon" sizes="16x16" href="{{ asset('vendor/webkul/ui/assets/images/favicon.ico') }}" />
         @endif

         <link rel="stylesheet" href="{{ asset('admin-themes/adminLTE/assets/css/admin.css') }}">
         <link rel="stylesheet" href="{{ asset('vendor/webkul/ui/assets/css/ui.css') }}">

         @yield('css')

         {!! view_render_event('bagisto.admin.layout.head') !!}
     </head>

     <body class="hold-transition login-page">
         <div id="app">

             <flash-wrapper ref='flashes'></flash-wrapper>

             {!! view_render_event('bagisto.admin.layout.content.before') !!}

             @yield('content')

             {!! view_render_event('bagisto.admin.layout.content.after') !!}

         </div>

         <script type="text/javascript">
             window.flashMessages = [];
             @if ($success = session('success'))
                 window.flashMessages = [{'type': 'alert-success', 'message': "{{ $success }}" }];
             @elseif ($warning = session('warning'))
                 window.flashMessages = [{'type': 'alert-warning', 'message': "{{ $warning }}" }];
             @elseif ($error = session('error'))
                 window.flashMessages = [{'type': 'alert-error', 'message': "{{ $error }}" }];
             @endif

             window.serverErrors = [];
             @if (isset($errors))
                 @if (count($errors))
                     window.serverErrors = @json($errors->getMessages());
                 @endif
             @endif
         </script>

         <script type="text/javascript" src="{{ asset('admin-themes/adminLTE/assets/js/admin.js') }}"></script>
         <script type="text/javascript" src="{{ asset('vendor/webkul/ui/assets/js/ui.js') }}"></script>

         @stack('javascript')

         {!! view_render_event('bagisto.admin.layout.body.after') !!}

         <div class="modal-overlay"></div>

     </body>

     </html>
