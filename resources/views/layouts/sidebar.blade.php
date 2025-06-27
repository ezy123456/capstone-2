<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('img/app-logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle">
        <span class="brand-text font-weight-bold" style="letter-spacing: 2px; font-size: 22px;">Event<span class="text-danger">Tzy</span></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        @auth
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('img/user-photo-default.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
            </div>
        </div>
        @endauth

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('eventList')}}" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>Daftar Event</p>
                    </a>
                </li>

                @auth
                @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a href="{{route('userList')}}" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>Daftar User</p>
                    </a>
                </li>
                @endif

                @if(auth()->user()->role === 'member')
                <li class="nav-item">
                    <a href="{{route('registrationList')}}" class="nav-link">
                        <i class="nav-icon fa fa-bookmark"></i>
                        <p>Pesanan Saya</p>
                    </a>
                </li>
                @endif
                @endauth

                @auth
                <li class="nav-item">
                    <form id="logout-form" action="{{route('logout')}}" method="post">
                        @csrf
                    </form>
                    <a href="javascript:void(0)" class="nav-link" onclick="$('#logout-form').submit();">
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>Logout</p>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{route('login')}}" class="nav-link">
                        <i class="nav-icon fa fa-sign-in"></i>
                        <p>Login</p>
                    </a>
                </li>
                @endauth
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>