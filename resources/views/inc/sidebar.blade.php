<!-- Main Sidebar -->
<aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0" style="z-index: 1040">
    <div class="main-navbar">
        <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
            <a class="navbar-brand w-100 mr-0" href="{{route('home')}}" style="line-height: 25px;">
                <div class="d-table m-auto">

                    <span class="d-none d-md-inline ml-1 font-weight-bold" style="font-family: 'Chilanka', cursive;">Yarn Museum</span>
                </div>
            </a>
            <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
                <i class="material-icons">&#xE5C4;</i>
            </a>
        </nav>
    </div>
    <div class="nav-wrapper" style="overflow-y: auto;">
        <ul class="nav nav--no-borders flex-column">
            <li class="nav-item">
                <a class="nav-link {{Route::current()->getName() == 'home'?'active':''}}" href="{{route('home')}}">
                    <i class="material-icons"></i>
                    <span>Dashboards</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                   aria-expanded="false">
                    <i class="material-icons"></i>
                    <span>Dyeing Manage</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item " href="{{route('factory.index')}}">Factory Entry</a>
                    <a class="dropdown-item " href="{{route('buyer.index')}}">Buyer Entry</a>
                    <a class="dropdown-item " href="{{route('style.index')}}">Style Entry</a>
                    <a class="dropdown-item " href="{{route('colour.index')}}">Colour Entry</a>
                    <a class="dropdown-item " href="{{route('process.index')}}">Process Entry</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::current()->getName() == 'order.index'?'active':''}}"
                   href="{{route('order.index')}}">
                    <i class="material-icons"></i>
                    <span>Order Receive</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::current()->getName() == 'grey.index'?'active':''}}"
                   href="{{route('grey.index')}}">
                    <i class="material-icons"></i>
                    <span>Grey Receive</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::current()->getName() == 'Lab.index'?'active':''}}"
                   href="{{route('Lab.index')}}">
                    <i class="material-icons"></i>
                    <span>LAB Entry</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::current()->getName() == 'batch.index'?'active':''}}" href="{{route('batch.index')}}">
                    <i class="material-icons"></i>
                    <span>Batch</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::current()->getName() == 'process-entry.index'?'active':''}}" href="{{route('process-entry.index')}}">
                    <i class="material-icons"></i>
                    <span>Process</span>
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link {{Route::current()->getName() == 'finished.index'?'active':''}}" href="{{route('finished.index')}}">--}}
{{--                    <i class="material-icons"></i>--}}
{{--                    <span>Finished Receive</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="nav-item">
                <a class="nav-link {{Route::current()->getName() == 'delivery.index'?'active':''}}" href="{{route('delivery.index')}}">
                    <i class="material-icons"></i>
                    <span>Delivery Challan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::current()->getName() == 'bill.index'?'active':''}}" href="{{route('bill.index')}}">
                    <i class="material-icons"></i>
                    <span>Bill</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                   aria-expanded="false">
                    <i class="material-icons"></i>
                    <span>Report</span>
                </a>
                <div class="dropdown-menu dropdown-menu-small">
                    <a class="dropdown-item " href="{{route('report.order')}}">Order Report</a>
                    <a class="dropdown-item " href="{{route('report.stock')}}">Stock Report</a>
                </div>
            </li>
        </ul>

    </div>
</aside>
<!-- End Main Sidebar -->
