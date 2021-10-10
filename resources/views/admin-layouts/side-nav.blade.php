<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('images/avatar.jpeg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::guard('admin')->user()->first_name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <span style="color:white">
   {{--  {{print_r($global_admin_menus)}} --}}
    {{-- {{$global_admin_menus}} --}}
    </span>

    <ul class="sidebar-menu tree" data-widget="tree">
        {{-- <span style="color: white">{{print_r($global_user_menus)}}</span> --}}
        {{-- <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview menu-open">
          <a href="{{route('dashboard.home')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
         
          </a>

        </li>
 --}}
        <li>
            <a href="{{route('admin.home')}}">
                <i class="fa fa-home"></i>
                <span class="nav-label">Home</span>
            </a>
        </li>
        @if(count($global_admin_menus) > 0)
          @foreach($global_admin_menus as $key => $label)
            @if($key != '')
              <li class="header">{{$key}}</li>
            @endif

            @foreach($label as $menu)
              @if($menu['menu_obj']->is_dropdown == 1)
                <li class="treeview">
                  <a href="#">
                    <i class="{{$menu['menu_obj']->icon}}"></i>
                    <span>{{$menu['menu_obj']->menu_name}}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    @if(count($menu['functions']) > 0)
                      @foreach($menu['functions'] as $function)
                        @if($function['function_obj']->function_is_nav == 1)
                          <li>
                            <a href="{{route($function['function_obj']->function_route)}}"><i class="{{$function['function_obj']->function_icon != ''  ? $function['function_obj']->function_icon: 'fa fa-chevron-right' }}"></i> {{$function['function_obj']->function_label}}</a>
                          </li>
                        @endif

                      @endforeach
                    @endif

                  
                  </ul>
                </li>

              @else
                

              @endif
            @endforeach
          @endforeach
        @endif





        
      </ul>
      
      

     
    </section>
    <!-- /.sidebar -->
  </aside>