<div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('/dashboard') }}" class="site_title"><i class="fa fa-users"></i><span style="color: #fff;">Laravel Admin</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('images/useravatar.png')}}" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->first_name}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Main Navigation</h3>
                
                <ul class="nav side-menu">
                  <li class="{{ request()->is('dashboard') ? 'active' : '' }}"><a href="{{url('/dashboard')}}"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                  @if(Auth::check() && Auth::user()->hasRole('super_admin'))
                  
                   <li><a href="{{ route('role.index') }}"><i class="fa fa-user"></i> Roles </a></li>
                   @endif
                   <li><a href="{{ route('user.index') }}"><i class="fa fa-users"></i> Users </a></li>
                </ul>
              </div>
              
            </div>
            <!-- /sidebar menu -->
          </div>