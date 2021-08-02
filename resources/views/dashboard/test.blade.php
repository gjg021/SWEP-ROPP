<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Star Admin Premium Bootstrap Admin Dashboard Template</title>
    @include('layouts.css-plugins')

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

@include('layouts.js-plugins')

</body>
</html>