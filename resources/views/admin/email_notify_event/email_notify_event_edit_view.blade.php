     
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
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                            @endif
                    <h1>Chỉnh sửa thông tin sự kiện</h1>
                    <form action="{{route('email_notify_event.update',$email_notify_event->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group
                        ">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$email_notify_event->title}}">
                        </div>
                        <div class="form-group
                        ">
                            <label for="content">Nội dung</label>
                            <textarea name="content" id="editor" cols="30" rows="10">
                                <div>
                                    {!!$email_notify_event->content!!}
                                </div>
                            </textarea>
                        </div>
                        <div class="form-group
                        ">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                    </div>
                    </div>
                </div>
                </div>

            </div>

 <script>
       CKEDITOR.replace( 'editor', {
        filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserWindowWidth: '1000',
        filebrowserWindowHeight: '700'
    } );
</script>