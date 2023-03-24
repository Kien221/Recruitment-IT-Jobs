
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
                            
                            <li class="menu">
                               
                                <div class="profile">
                                    <img src="{{asset('storage/images/'.session('avatar'))}}" alt="">
                                    <span class="name_user">{{session('hr_name')}}</span>
                                    <i class="fa-solid fa-chevron-down"></i>
                                </div>
                             
                            </li>
                            <li class="menu">
                                <a href="{{route('logout')}}" class="icon_link">logout</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

        </div>
      </div>
    </div>