<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SWEP | Online Payment</title>
  @include('layouts.css-plugins')
  <style>
    .navbar-brand-wrapper{
      background: #fff !important;
    }
    .sidebar{
      background: linear-gradient(to top, #fff, #fff);
    }
    .sidebar > .nav:not(.sub-menu) > .nav-item:hover:not(.nav-profile):not(.hover-open) > .nav-link:not([aria-expanded="true"]) {
      background: #2196f3;
    }
  </style>

</head>
<body>
<div class="container-scroller">
  @include('layouts.admin-topnav')


  <div class="container-fluid page-body-wrapper">
    @include('layouts.admin-sidenavs')

    <div class="main-panel">
      <div class="content-wrapper">
        @yield('content')
      </div>

      <footer class="footer">
        <div class="container-fluid clearfix">
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Management Information System</span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Sugar Regulatory Administration</span>
        </div>
      </footer>

    </div>
  </div>
</div>
@yield('modals')
@include('layouts.js-plugins')
@yield('scripts')
</body>
</html>