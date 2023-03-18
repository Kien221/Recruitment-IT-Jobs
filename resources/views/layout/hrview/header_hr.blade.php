<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/public.css')}}">
    <link rel="stylesheet" href="{{asset('css/hr.css')}}">
    <link rel="stylesheet" href="{{asset('css/applicant.css')}}">
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>{{ config('app.name')}} @yield('title')</title>
</head>
<body>
    <div id="header">
        <div class="middle-header" id="header_hr_view">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="left">
                            <a href="{{route('home')}}">
                                <img src="https://tuyendung.topcv.vn/app/_nuxt/img/topcv-for-bussiness-logo.8cae76d.png" alt="" class="logo_hr_view">
                            </a>
                        </div>
                    </div>  
                    <div class="col-md-9">
                        <div class="right_applicant_view">
                            <ul class="list-menu">
                                <li class="menu">
                                    <a href="{{route('hr.create_post.view')}}" class="icon_link"><i class="fa-regular fa-pen-to-square"></i>Đăng bài</a>
                                </li>
                                <li class="menu">
                                    <a href="#" class="icon_link"><i class="fa-regular fa-pen-to-square"></i>Tìm CV</a>
                                </li>
                                <li class="menu">
                                    <a href="#" class="icon_link"><i class="fa-regular fa-circle-question"></i>Trợ giúp</a>
                                </li>
                                <li class="menu">
                                    <a href="#" class="icon_link"><i class="fa-solid fa-comment"></i>Connect</a>
                                </li>
                                <li class="menu">
                                    <a href="#" class="icon_link"><i class="fa-solid fa-bell"></i></a>
                                </li>
                                <li class="menu">
                                    @if(session('id_hr'))
                                    <div class="profile">
                                        <img src="{{asset('storage/images/'.session('avatar'))}}" alt="">
                                        <span class="name_user">{{session('hr_name')}}</span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                    @endif
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>