<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('theme') }}/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('theme') }}/img/favicon.png">
  <title>@yield('title', 'Epic Trainer') - {{app_name()}}</title>

  <meta name="_token" content="{{ csrf_token() }}" />
  <meta name="public_url" content="{{ asset('') }}">

  <meta name="description" content="@yield('meta_description', '')">
  <meta name="author" content="@yield('meta_author', '')">
  @yield('meta')

  @yield('before-styles-end')

  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('theme') }}/css/nucleo-icons.css" rel="stylesheet" />
  <link href="{{ asset('theme') }}/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('theme') }}/css/material-dashboard.css?v=3.0.1" rel="stylesheet" />

  @yield('plugin-css')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="{{ asset('theme') }}/js/jquery.sparkline/jquery.sparkline.min.js"></script>
  {{-- <link rel="stylesheet" href="{{ asset('theme') }}/css/bootstrap-select/bootstrap-select.css"> --}}
  <link id="pagestyle" href="{{ asset('theme') }}/css/new-styles.css" rel="stylesheet" />
    {!! Html::style('vendor/tooltipster-master/tooltipster.css?v='.time()) !!}
  
  <style>
    .help-block{
      color: red;
    }
  </style>
  @yield('required-styles-for-this-page')

</head>
<body class="g-sidenav-show  bg-gray-200">

    @include('super-admin.layout.nav')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @include('super-admin.layout.navbar')   

        <div class="container-fluid py-4">

            @yield('content')

            @include('layouts.includes.footer')

        </div>
  </main>

    @include('layouts.includes.theme-setting')

    <script>
        var public_url = $('meta[name="public_url"]').attr('content');
    </script>
    


    <script src="{{ asset('theme') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('theme') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('theme') }}/js/plugins/smooth-scrollbar.min.js"></script>
    <!-- Kanban scripts -->
    <script src="{{ asset('theme') }}/js/plugins/dragula/dragula.min.js"></script>
    <script src="{{ asset('theme') }}/js/plugins/jkanban/jkanban.js"></script>
    {{-- <script src="{{ asset('theme') }}/js/bootstrap-select/bootstrap-select.min.js"></script> --}}
    <script src="{{ asset('theme') }}/js/plugins/perfect-scrollbar.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @yield('required-script-for-this-page')
    
    @yield('script-after-page-handler')

    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('theme') }}/js/material-dashboard.min.js?v=3.0.1"></script>
    <script>
        $(document).ready(function(){

            $("#white-version").trigger('click');

        });
    </script>

    <script type="text/javascript">
    $('.delLink2').click(function(){
        var delUrl = $(this).data('del-url');
        Swal.fire({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this Account!",
          icon: "warning",
          showCancelButton: true,
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.href = delUrl;
          }
        });
    });

    $('.sendLink').click(function(){
        var sendUrl = $(this).data('send-url');
        Swal.fire({
          title: "Are you sure?",
          text: "Account activation confirmation email!",
          showCancelButton: true,
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location.href = sendUrl;
          }
        });
    })
</script>
</body>
</html>
