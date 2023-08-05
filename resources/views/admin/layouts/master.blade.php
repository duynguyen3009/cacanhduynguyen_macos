<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Duy Nguyễn Cá Cảnh</title>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Duy Nguyễn Cá Cảnh">
        <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="shortcut icon" href="favicon.ico">
        <!-- FontAwesome JS-->
        <script defer src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
        <!-- App CSS -->  
        <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
        <link id="theme-style" rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/jquery-ui.css') }}">
        @stack('css')
    </head>
    <body class="app">
        <header class="app-header fixed-top">
            @include('admin.layouts.navigation')
            @include('admin.layouts.sidebar')
        </header>

        <div class="app-wrapper">
            @yield('main')
            @include('admin.layouts.footer')
        </div>
        <script src="{{ asset('assets/plugins/jquery.min.js') }}" ></script>
        <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.js') }}" ></script>
        <script src="{{ asset('assets/plugins/sweetalert.min.js') }}" ></script>
        <script src="{{ asset('assets/plugins/notify.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/plugins/popper.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>  
        <!-- Page Specific JS -->
        <script src="{{ asset('assets/js/app.js') }}"></script> 
        <script src="{{ asset('assets/js/common.js') }}"></script> 
        <script>
            $( function() {
              $( ".datepicker" ).datepicker();
            } );
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @stack('js')
    </body>
</html>