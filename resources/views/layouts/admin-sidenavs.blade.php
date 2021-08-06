
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="{{asset('template/staradmin/src/assets/images/faces/face8.jpg')}}" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name" style="color: #5a5a5a">{{Auth::guard('web')->user()->first_name}} {{Auth::guard('web')->user()->last_name}}</p>
                    <p class="designation" style="color: #5a5a5a">Premium user</p>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.home')}}">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title" style="color: #5a5a5a; font-size: 13px;">Dashboard</span>
            </a>
        </li>

        @if(count($global_user_menus) > 0)
            @foreach($global_user_menus as $key => $label)
                @foreach($label as $menu)
                    @if($menu['menu_obj']->is_dropdown == 1)
                        <li class="nav-item" style="color: #5a5a5a">
                            <a class="nav-link" data-toggle="collapse" href="#{{$menu['menu_obj']->slug}}" aria-expanded="false" aria-controls="{{$menu['menu_obj']->slug}}">
{{--                                <i class="fa {{$menu['menu_obj']->icon}}"></i>--}}
                                <span class="menu-title" style="color: #5a5a5a; font-size: 13px;">{{$menu['menu_obj']->menu_name}}</span>
                                <i class="menu-arrow" style="color: #5a5a5a"></i>
                            </a>
                            <div class="collapse" id="{{$menu['menu_obj']->slug}}">
                                @if(count($menu['functions']) > 0)
                                    <ul class="nav flex-column sub-menu">
                                        @foreach($menu['functions'] as $function)
                                            @if($function['function_obj']->function_is_nav == 1)
                                                <li class="nav-item" style="color: #5a5a5a">
                                                    <a class="nav-link" style="color: #5a5a5a"  href="{{route($function['function_obj']->function_route)}}">
{{--                                                        <i class="{{$function['function_obj']->function_icon != '' ? $function['function_obj']->function_icon : 'fa fa-chevron-right'}}"></i>--}}
                                                        {{$function['function_obj']->function_label}}
                                                    </a>
                                                </li>

                                            @endif

                                        @endforeach
                                    </ul>
                                @endif



                            </div>
                        </li>


                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard.home')}}">
                                <i class="menu-icon typcn typcn-document-text"></i>
                                <span class="menu-title" style="color: #5a5a5a">Dashboard</span>
                            </a>
                        </li>

{{--                        <li class="active treeview menu-open">--}}
{{--                            <a href="{{route('dashboard.home')}}">--}}
{{--                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>--}}

{{--                            </a>--}}

{{--                        </li>--}}

                    @endif
                @endforeach
            @endforeach
        @endif

{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">--}}
{{--                <i class="menu-icon typcn typcn-coffee"></i>--}}
{{--                <span class="menu-title">Basic UI Elements</span>--}}
{{--                <i class="menu-arrow"></i>--}}
{{--            </a>--}}
{{--            <div class="collapse" id="ui-basic">--}}
{{--                <ul class="nav flex-column sub-menu">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="pages/forms/basic_elements.html">--}}
{{--                <i class="menu-icon typcn typcn-shopping-bag"></i>--}}
{{--                <span class="menu-title">Form elements</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="pages/charts/chartjs.html">--}}
{{--                <i class="menu-icon typcn typcn-th-large-outline"></i>--}}
{{--                <span class="menu-title">Charts</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="pages/tables/basic-table.html">--}}
{{--                <i class="menu-icon typcn typcn-bell"></i>--}}
{{--                <span class="menu-title">Tables</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" href="pages/icons/font-awesome.html">--}}
{{--                <i class="menu-icon typcn typcn-user-outline"></i>--}}
{{--                <span class="menu-title">Icons</span>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">--}}
{{--                <i class="menu-icon typcn typcn-document-add"></i>--}}
{{--                <span class="menu-title">User Pages</span>--}}
{{--                <i class="menu-arrow"></i>--}}
{{--            </a>--}}
{{--            <div class="collapse" id="auth">--}}
{{--                <ul class="nav flex-column sub-menu">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="pages/samples/login.html"> Login </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="pages/samples/register.html"> Register </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="pages/samples/error-404.html"> 404 </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="pages/samples/error-500.html"> 500 </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </li>--}}
    </ul>
</nav>