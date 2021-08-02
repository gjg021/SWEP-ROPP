<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SWEP | ONLINE PAYMENT PORTAL</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.css-plugins')  
    @yield('utils')
  </head>
  <body class="hold-transition sidebar-mini skin-green {!! Auth::check() ? __sanitize::html_encode(Auth::user()->color) : '' !!}" style="zoom:97%;">

    <div id="loader"></div>

    <div class="wrapper">

      @include('layouts.admin-topnav')
      @include('layouts.admin-sidenavs') 

      <div class="content-wrapper" style="height:500em;"> 
        @yield('content')
      </div>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2019-2020.</strong> All rights
        reserved.
      </footer>

    </div>

    {{-- FORM ERROR MODAL --}}  
    <div class="modal fade modal-danger" data-backdrop="static" id="error_fields">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> &nbsp;Whoops!</h4>
          </div>
          <div class="modal-body">
            <p style="font-size: 17px;">
              There were some problems with your input fields.
            </p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-outline" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    @include('layouts.js-plugins')
    
    @yield('modals')

    @yield('scripts')




    <script type="text/javascript">
      $(document).ready(function(){
        cure_url = window.location.href;

        // setTimeout(function(){
        //   $("a[href='"+cure_url+"']").parent('li').parent('ul').siblings('a').click();
        // },200);
        
        $("a[href='"+cure_url+"']").parent('li').parent('ul').parent('li').addClass('active');


        $("a[href='"+cure_url+"']").parent('li').addClass('active');
        

      })

      
    </script>
  </body>

</html>