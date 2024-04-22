 
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
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('ckeditor/ckfinder.js')}}"></script>
    <link href="{{asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/toasty.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/toasty.js"></script>
    <style>
        .form-group{
            margin-bottom: 1rem;
        }
        .form-group label{
            font-weight: 600;
            color: black;
        }
        .form-group button{
            margin-left: 50%;
            transform: translateX(-50%);
            margin-top: 30px;
            padding: 10px 30px;
        }


    </style>
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layout.admin.sidebar_admin')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layout.admin.topbar_admin')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="col-xs-9">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa thông tin tiện ích sinh viên</h6>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                            @endif
                            <form action="{{route('admin.management_services.edit',$service->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group
                                ">
                                    <label for="name">Tên dịch vụ</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$service->name}}">
                                </div>
                                <div class="form-group
                                ">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control" id="introduce_service" name="introduce_service" rows="3">{{$service->introduce_service}}</textarea>
                                </div>
                                <div class="form-group
                                ">
                                    <label for="description">Gia</label>
                                    <textarea class="form-control" id="price" name="price" rows="3">{{number_format($service->price)}}</textarea>
                                </div>
                                <div class="form-group
                                ">
                                    <label for="description">Thời hạn dịch vụ</label>
                                    <input type="text" class="form-control" id="expired_service" name="expired_service" value="{{$service->expired_service}}">
                                </div>
                                <div class="form-group
                                ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="description">Lượt Xem CV mỗi ngày</label>
                                            <input type="text" class="form-control" id="view_every_day" name="view_every_day" value="{{$service->view_every_day}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="description">Lượt Search CV mỗi ngày</label>
                                            <input type="text" class="form-control" id="search_every_day" name="search_every_day" value="{{$service->search_every_day}}">
                                        </div>

                                    </div>
                                </div>
 
                                <div class="form-group
                                ">
                                    <div class="row">   
                                        <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                    <label for="description" style="color:black;font-weight:600">Công ty Hot</label>
                                                </div>
                                                <div class="col-md-6">
                                                    @if($service->hot_company == 1)
                                                    <input type="checkbox" class="form-control" id="hot_company" name="hot_company" value="{{$service->hot_company}}" checked>
                                                    @else
                                                    <input type="checkbox" class="form-control" id="hot_company" name="hot_company" value="{{$service->hot_company}}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                    <label for="description" style="color:black;font-weight:600">Khung viền bài tuyển dụng</label>
                                                </div>
                                                <div class="col-md-6">
                                                    @if($service->border_post == 1)
                                                    <input type="checkbox" class="form-control" id="border_post" name="border_post" value="{{$service->border_post}}" checked>
                                                    @else
                                                    <input type="checkbox" class="form-control" id="border_post" name="border_post" value="{{$service->border_post}}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                
                                
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </form>
                        </div>
                    </div>
                </div>
                </div>

            </div>
