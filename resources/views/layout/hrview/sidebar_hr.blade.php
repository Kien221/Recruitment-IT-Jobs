<div class="col-md-2">
                <div class="nav_hr_view">
                    @if(session('id_hr'))
                    <div class="infor_hr">
                        <img src="{{asset('storage/images/'.session('avatar'))}}" alt="">
                        <div class="hr_infor_basic">
                            <span class="hr_name">{{session('hr_name')}}</span>
                            <p>Employer</p>
                            <p>Tài khoản xác thực: <span>Cấp 1/5</span></p>
                        </div>
                    </div>
                    @endif
                    <ul class="list_nav_hr_view">
                        <li class="list_nav_hr_view_item">
                            <a href=""><i class="fa-regular fa-file"></i> Bảng tin</a>
                        </li>
                        <li class="list_nav_hr_view_item">
                            <a href="#" class="icon_link"><i class="fa-regular fa-pen-to-square"></i>Tin Tuyển Dụng</a>
                        </li>
                        <li class="list_nav_hr_view_item">
                            <a href="#" class="icon_link"><i class="fa-regular fa-user"></i>Quản lý CV</a>
                            
                        </li>
                        <li class="list_nav_hr_view_item">
                            <a href="{{route('create.company.view')}}" class="icon_link"><i class="fa-solid fa-gear"></i>Cài đặt tài khoản</a>
                        </li>
                        <li class="list_nav_hr_view_item">
                            <a href="#" class="icon_link"><i class="fa-regular fa-bell"></i>Hệ thống thông báo</a>
                        </li>
                        <li class="list_nav_hr_view_item">
                            <a href="#" class="icon_link"><i class="fa-regular fa-envelope"></i>Hộp thư hỗ trợ</a>
                        </li>

                    </ul>
                    <div class="author">
                        Version v2.32.8<br>
                        © 2021 TOPCV. All rights reserved.
                    </div>

                </div>
            </div>