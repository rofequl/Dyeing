<div class="main-navbar sticky-top bg-white">
    <!-- Main Navbar -->
    <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
        <ul class="nav main-navbar__search w-100 d-none d-md-flex d-lg-flex py-2">
            <li class="nav-item">
                <a class="nav-link" style="color: #3d5170" href="{{route('report.order')}}">Order Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: #3d5170" href="{{route('report.stock')}}">Stock Report</a>
            </li>
        </ul>
        <ul class="navbar-nav border-left flex-row ">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#"
                   role="button" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle mr-2" src="{{asset(Auth::user()->image)}}"
                         alt="User Avatar" style="height: 2.5rem!important;"> <span
                        class="d-none d-md-inline-block">{{Auth::user()->name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small" style="left: 0!important;">
                    <a class="dropdown-item" href="{{route('user.index')}}"><i class="material-icons"></i> Profile</a>
                    <a class="dropdown-item" href="{{route('UserManage')}}"><i class="material-icons"></i> User
                        Management</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" href="/">
                        <i class="material-icons text-danger"></i> Logout </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                        <input type="hidden" name="type" value="admin">
                    </form>
                </div>
            </li>
        </ul>
        <nav class="nav">
            <a href="#"
               class="nav-link nav-link-icon toggle-sidebar d-sm-inline d-md-none text-center border-left"
               data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
               aria-controls="header-navbar">
                <i class="material-icons">&#xE5D2;</i>
            </a>
        </nav>
    </nav>
</div> <!-- / .main-navbar -->
