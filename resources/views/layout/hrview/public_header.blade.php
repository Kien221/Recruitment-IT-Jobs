
<div id="header">
        <div class="top-header">
            <div class="top-header-left">
                <a href="{{route('home')}}">
                    <img src="{{asset('image/Logo_TopCV_no_slogan.png')}}" alt="" class="logo">
                </a>
                <h1 class="text-header"><span>Việc Làm</span> IT Hàng Đầu</h1>
            </div>
            <div class="top-header-right">
                <ul class="list-info">
                    <li class="number_phone">
                        <a href="#"><i class="fa-solid fa-phone"></i> 0395004764</a>
                        <p class="space">|</p>
                    </li>
                    <li class="post_text">
                        <a href="#">
                            <i class="fa-solid fa-feather"></i> Đăng tin
                        </a> 
                        <p class="space">|</p>
                            
                    </li>
                    <li class="contact">
                        <a href="#">

                            <i class="fa-solid fa-address-book"></i> Liên hệ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
      <div class="middle-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <ul class="list-menu">
                            <li class="menu">
                                <a href="{{route('home')}}">
                                    <i class="fa-solid fa-bars"></i>
                                </a>
                            </li>
                            <li class="menu">
                                <a href="{{route('hr.index')}}">Trang chủ</a>
                            </li>
                            <li class="menu">
                                <a href="#">Công Ty IT</a>
                            </li>
                            <li class="menu">
                                <a href="#">Blog IT</a>
                            </li>
                            <li class="menu">
                                <a href="#">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right_applicant_view">
                        <ul class="list-menu">
                            <li class="menu">
                                <a href="#" class="icon_link"><i class="fa-solid fa-comment"></i></a>
                            </li>
                            <li class="menu">
                                <a href="#" class="icon_link"><i class="fa-solid fa-bell"></i></a>
                            </li>
                            
                            <li class="menu" id="submenu">
                               
                                <div class="profile">
                                    <img src="{{asset('storage/images/'.session('avatar'))}}" alt="">
                                    <span class="name_user">{{session('hr_name')}}</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>

                                <ul class="submenu">
                                <li class="list_nav_hr_view_item">
                                            <a href="{{route('hr.index')}}"><i class="fa-regular fa-file"></i> Bảng tin</a>
                                        </li>
                                        <li class="list_nav_hr_view_item">
                                            <a href="{{route('show.posted.view')}}" class="icon_link"><i class="fa-regular fa-pen-to-square"></i>Tin Tuyển Dụng</a>
                                        </li>
                                        <li class="list_nav_hr_view_item">
                                            <a href="{{route('list.applicants.accepted')}}" class="icon_link"><i class="fa-regular fa-user"></i>Quản lý CV</a>
                                            
                                        </li>
                                        <li class="list_nav_hr_view_item">
                                            <a href="{{route('create.company.view')}}" class="icon_link"><i class="fa-solid fa-gear"></i>Cài đặt tài khoản</a>
                                        </li>
                                        <li class="list_nav_hr_view_item">
                                            <a href="{{route('email.from.admin')}}" class="icon_link"><i class="fa-regular fa-bell"></i>Hệ thống thông báo</a>
                                        </li>
                                        <li class="list_nav_hr_view_item">
                                            <a href="#" class="icon_link"><i class="fa-regular fa-envelope"></i>Hộp thư hỗ trợ</a>
                                        </li>
                                        <li class="list_nav_hr_view_item">
                                            <a href="#" class="icon_link">Đăng xuất</a>
                                        </li>
                                </ul>
                            <style>
                                            .submenu {
                                                display: none;
                                                position: fixed;
                                                background-color: #f9f9f9;
                                                min-width: 190px;
                                                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                                                z-index: 1000;
                                                padding: 0px;
                                                list-style: none;
                                                border-radius: 5px;
                                            }
                                            #submenu .submenu a{
                                                text-decoration: none;
                                                color: black;
                                            }

                                            #submenu:hover .submenu {
                                                display: block;
                                                

                                            }
                                            .list_nav_hr_view_item{
                                                padding: 20px;
                                                text-decoration: none;
                                                display: block;
                                                color: black;
                                                font-size: 14px;
                                                border-bottom: 1px solid #f1f1f1;
                                            }
                                            .list_nav_hr_view_item i{
                                                margin-right: 10px;
                                            }

                                    </style>
                             
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

        </div>
      </div>
    </div>