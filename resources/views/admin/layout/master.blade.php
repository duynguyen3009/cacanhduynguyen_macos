<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Duy Nguyễn Cá Cảnh </title>
  <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/simple-line-icons/css/simple-line-icons.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <style>
    .select2-selection {
      position: relative;
    }

    .select2-selection__rendered {
      position: absolute;
      top: 0;
    }
  </style>
  @stack('css')
</head>

<body>
  <div class="container-scroller">
    
    @include('admin.layout.navigation')
    <div class="container-fluid page-body-wrapper" style="padding-top: 0px">
      @include('admin.layout.sidebar')
      <div class="main-panel">
        @yield('main')
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/plugins/jquery.min.js') }}" ></script>
  <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.js') }}" ></script>
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" ></script>
  <script src="{{ asset('assets/plugins/sweetalert.min.js') }}" ></script>
  <script src="{{ asset('assets/plugins/notify.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  {{-- <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/off-canvas.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/template.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/settings.js') }}"></script> --}}
  {{-- <script src="{{ asset('assets/js/todolist.js') }}"></script> --}}
  <script src="{{ asset('assets/js/common.js') }}"></script>
  <script>
    $( function() {
      $( ".datepicker" ).datepicker({
        dateFormat: 'dd/mm/yy'
      });

      $('.select2').select2({ 
        allowClear: true,
        placeholder: "Select a color",
        width: '50%',
        theme: "classic",
      });
    } );

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function searchStatus(el) {
      var status = $(el).data('value');
      $('#searchForm input[name="search[status]"]').val(status);
      $('#searchForm').submit();
    }
    
  </script>
  @stack('js')
</body>

</html>
