<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework.">
  <meta name="author" content="CodedThemes">

  <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon"> 
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
  
  <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/fonts/material.css')}}" />
  
  <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" id="main-style-link"/>
  <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css')}}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  
  @stack('styles')
</head>
<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  @include('layouts.partials.sidebar')
  @include('partials.navbar')
  <div class="pc-container">
    <div class="pc-content">
      @include('partials.flash-messages')

      @yield('content')
    </div>
  </div>
  @include('partials.footer')
  <script src="{{ asset('assets/js/plugins/popper.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/simplebar.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/js/fonts/custom-font.js')}}"></script>
  <script src="{{ asset('assets/js/pcoded.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/feather.min.js')}}"></script>

  <script src="{{ asset('assets/js/plugins/apexcharts.min.js')}}"></script>
  <script src="{{ asset('assets/js/pages/dashboard-default.js')}}"></script>
  <script>
    layout_change('light');
    change_box_container('false');
    layout_rtl_change('false');
    preset_change("preset-1");
    font_change("Public-Sans");
  </script>

  @stack('scripts')
</body>

</html>