
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name','Thông tin tiện ích sinh viên')}} @yield('title')</title>
    <link rel="icon" href="https://static.topcv.vn/v4/image/logo/topcv-logo-tet-holiday.png" type="image/x-icon" />
    <!-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/toasty.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/toasty.js"></script>
</head>
<html>

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">TopCV ADMIN</div>
    </a>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.index.view')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang chủ</span></a>
    </li>
    
    <!-- Divider -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Quản Lý Danh Mục</span></a>
    </li>
    
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('management.post')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Quản lý bài viết</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{route('management.company')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Quản lý công ty</span></a>
    </li>
    
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-fw fa-table"></i>
            <span>Quản lý người dùng</span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="{{route('management.hr')}}">Quản lý HR</a></li>
            <li><a class="dropdown-item" href="{{route('management.applicant')}}">Quản lý Applicant</a></li>
        </ul>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{route('management.services')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Quản lý gói dịch vụ</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="{{route('notify.event')}}">
            <i class="fas fa-fw fa-table"></i>
            <span>Thông báo sự kiện</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    
    </ul>

    <script src="{{asset('js/vendor/jquery.min.js')}}"></script>
    <script src="{{asset('js/vendor/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('js/vendor/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/admin.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('js/vendor/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/chart-pie-demo.js')}}"></script>
</html>