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
                                <a href="{{route('home')}}">Việc làm IT</a>
                            </li>
                            <li class="menu">
                                <a href="{{route('applicantView')}}">Tạo CV</a>
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


                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
                            <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
                            <script>

                                // Enable pusher logging - don't include this in production
                                Pusher.logToConsole = true;

                                var pusher = new Pusher('89f157943ae133692fc2', {
                                cluster: 'ap1'
                                });

                                var channel = pusher.subscribe('Recruitment-channel.'.{{session('id_applicant')}});
                                channel.bind('hr-accept-applicantcv', function(data) {
                                alert(JSON.stringify(data));
                                });
                            </script>
                                                        
                            <li class="menu">
                               
                                <div class="profile">
                                    @if(session('avatar') != null)
                                    <img src="{{asset('storage/'.session('avatar'))}}" alt="">
                                    @endif
                                    @if(session('avatar_newuser') !== null)
                                    <img src="{{session('avatar_newuser')}}" alt="">
                                    @endif
                                    <span class="name_user">{{session('applicant_name')}}</span>
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