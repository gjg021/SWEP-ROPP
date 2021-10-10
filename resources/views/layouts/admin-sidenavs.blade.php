<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{asset('images/sra_logo_sm.png')}}"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{Auth::guard('web')->user()->first_name}} {{Auth::guard('web')->user()->last_name}}</span>
                        <span class="text-muted text-xs block">{{Auth::guard('web')->user()->business_name}}<b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                        <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                        <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="{{route('dashboard.home')}}">
                    <i class="fa fa-home"></i>
                    <span class="nav-label">Home</span>
                </a>
            </li>
            @if(count($global_user_menus) > 0)
                @foreach($global_user_menus as $key => $label)
                    @foreach($label as $menu)
                        @if($menu['menu_obj']->is_dropdown == 1)
                            <li>
                                <a href="#{{$menu['menu_obj']->slug}}">
                                    <i class="{{$menu['menu_obj']->icon}}"></i>
                                    <span class="nav-label">{{$menu['menu_obj']->menu_name}}</span>
                                    <span class="fa arrow"></span>
                                </a>
                                @if(count($menu['functions']) > 0)
                                    <ul class="nav nav-second-level collapse">
                                        @foreach($menu['functions'] as $function)
                                            @if($function['function_obj']->function_is_nav == 1)
                                                <li>
                                                    <a href="{{route($function['function_obj']->function_route)}}">
                                                        {{$function['function_obj']->function_label}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @else
                            <li class="active">
                                <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span> <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li class="active"><a href="{{route('dashboard.home')}}">Home</a></li>
                                </ul>
                            </li>
                        @endif
                    @endforeach
                @endforeach
            @endif
        </ul>
    </div>
</nav>