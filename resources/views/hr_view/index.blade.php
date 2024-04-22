
@section('title')- {{'Nhà Tuyển Dụng'}} @endsection
    @include('layout.hrview.header_hr')
    <div class="main_hr_view">
        <div class="row">
            @include('layout.hrview.sidebar_hr')
            <div class="col-md-10">
                <div class="content_hr_view">
                    <div class="compete_text">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>
                            Để đảm bảo quyền lợi cho các tin đăng trả phí,<b> Toppy AI sẽ tự động phân tích và điều tiết khả năng tiếp cận ứng viên của các tin đăng miễn phí</b>
                              dựa trên mức độ cạnh tranh của thị trường. Trong khoảng thời gian bị giới hạn, tin miễn phí của bạn có thể sẽ không được hiển thị trong kết quả tìm kiếm việc làm. Để giữ lợi thế cạnh tranh và đảm bảo hiệu quả cao nhất, bạn hãy sử dụng dịch vụ trả phí cho các tin của mình.</span>
                    </div>
                    <div class="main_content_hr_view">
                        <h5>Bảng Tin</h5>
                        @if (\Session::has('success'))
                        <div class="form-apply" id="form-apply" style="display:block">
                            <div class="content-form" style="margin-top:120px">
                                <div class="job_apply" style="float:right;font-size:25px;color:red;cursor:pointer">
                                    <span onclick="close_apply_form()">
                                        <i class="fa-sharp fa-solid fa-xmark"></i>
                                    </span>
                                </div>
                                <div class="method-apply" style="text-align:center">
                                    <img src="https://www.shutterstock.com/image-vector/partying-emoji-emoticon-party-horn-600nw-1992128765.jpg" alt="" style="width:200px">
                                    <div>
                                        <span style="color:#01b14f;font-size:20px">{!! \Session::get('success') !!}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="banner_hr_view">
                                    <img src="../assets/image/banner_12_2022.41b811e.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="banner_hr_view">
                                    <img src="../assets/image/banner_12_2022.41b811e.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="statistical">
                                    <span>Hiệu quả tuyển dụng</span>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="data_statistical campaign">
                                                <div class="data_campaign">
                                                    <span>{{$num_all_cv}}</span>
                                                    <p>CV tiếp nhận</p>
                                                </div>
                                                <i class="fa-solid fa-bullhorn"></i>
                                                
                                            </div>
                                            <div class="data_statistical post_hr">
                                                <div class="data_post">
                                                    <span>{{$num_posts}}</span>
                                                    <p>Tin tuyển dụng</p>
                                                </div>
                                                <i class="fa-regular fa-file"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="data_statistical cv_receive">
                                                <div class="data_cv_receive">
                                                    <span>{{$num_cv_accepted}}</span>
                                                    <p>CV đã chấp nhận</p>
                                                </div>
                                                <i class="fa-sharp fa-solid fa-file-pdf"></i>
                                            </div>
                                            <div class="data_statistical cv_new">
                                                <div class="data_cv_new">
                                                    <span>{{$num_cv_not_seen}}</span>
                                                    <p>CV ứng tuyển chưa xem</p>
                                                </div>
                                                <i class="fa-sharp fa-solid fa-file-import"></i>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="account_hr">
                                    <div class="avatar_infor_hr">
                                        <img src="{{asset('storage/images/'.session('avatar'))}}" alt="">
                                        <div class="infor_account_hr">
                                            <span>Chế Thanh Kiên</span>
                                            <p>Mã NTD: 502722   |  {{$hr->email}}
                                                <br>
                                                {{$hr->phoneNumber}}
                                            </p>                                           
                                        </div>
                                    </div>
                                    <div class="level_account">
                                        @if($level_account_hr != null)
                                        <p class="current_level">Gói dịch vụ đang sử dụng: <span>{{$level_account_hr->name}}</span></p>
                                        <div class="required_up_acctount">
                                            <i class="fa-regular fa-user"></i>
                                            <p><b>Nâng cấp tài khoản</b>: Mua các gói dịch vụ để <span>được lợi ích tuyển dụng tốt nhất</span>.</p>
                                        </div>
                                        <div class="required_up_acctount">
                                            <i class="fa-solid fa-bullhorn"></i>
                                            <div>
                                                <p><b>Lượt xem CV hôm nay : </b><span>{{$level_account_hr->used_views}}/{{$level_account_hr->view_every_day}}</span></p>
                
                                                <p><b>Lượt tìm kiếm CV hôm nay : </b><span>{{$level_account_hr->used_search}}/{{$level_account_hr->search_every_day}}</span></p>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="button_confirm_up_account">
                                            <a href="{{route('buy_service_view')}}">
                                                <button class="btn_update_infor">
                                                    Nâng cấp tài khoản
                                                </button>
                                            </a>
                                            <button class="more_infor">
                                                Tìm hiểu thêm
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="service suggest_ai">
                                            <span>Đề xuất từ Toppy AI</span>
                                            <p>Tự động phân tích bằng công nghệ trí tuệ nhân tạo</p>
                                            <div class="max_setting">
                                                <i class="fa-solid fa-gear"></i>
                                                <span>Tối ưu thiết lập</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="service service_expired">
                                            <span>Dịch vụ sắp hết hạn</span>
                                            <p>Hiện không có dịch vụ nào sắp hết hạn</p>
                                            <div class="max_setting">
                                                <i class="fa-solid fa-pen"></i>
                                                <a href="#">Quản lý dịch vụ</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>

                <div id="footer">
                    <div class="infor-partnership">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="infor-relate">
                                        <span>Về TopCV</span>
                                        <ul>
                                            <li>
                                                <a href="">Giới thiệu</a>
                                            </li>
                                            <li>
                                                <a href="">Góc báo chí</a>
                                            </li>
                                            <li>
                                                <a href="">Tuyển dụng</a>
                                            </li>
                                            <li>
                                                <a href="">Liên hệ</a>
                                            </li>
                                            <li>
                                                <a href="">Hỏi đáp</a>
                                            </li>
                                            <li>
                                                <a href="">Chính sách bảo mật</a>
                                            </li>
                                            <li>
                                                <a href="">Điều khoản sử dụng</a>
                                            </li>
                                            <li>
                                                <a href="">Quy chế hoạt động</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="infor-relate">
                                        <span>Cộng đồng TopCV</span>
                                        <ul>
                                            <li>
                                                <a href="">Blog</a>
                                            </li>
                                            <li>
                                                <a href="">Facebook</a>
                                            </li>
                                            <li>
                                                <a href="">Youtube</a>
                                            </li>
                                            <li>
                                                <a href="">Instagram</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="infor-relate">
                                        <span>Đối tác</span>
                                        <ul>
                                            <li>
                                                <a href="">TestCenter</a>
                                            </li>
                                            <li>
                                                <a href="">TopHR</a>
                                            </li>
                                            <li>
                                                <a href="">ViecNgay</a>
                                            </li>
                                            <li>
                                                <a href="">Happy Time</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="infor-relate">
                                        <span>Hồ sơ và CV</span>
                                        <ul>
                                            <li>
                                                <a href="">Quản lý CV của bạn</a>
                                            </li>
                                            <li>
                                                <a href="">TopCV Profile</a>
                                            </li>
                                            <li>
                                                <a href="">Hướng dẫn viết CV</a>
                                            </li>
                                            <li>
                                                <a href="">Review CV</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="infor-relate">
                                        <span>khám phá</span>
                                        <ul>
                                            <li>
                                                <a href="">Ứng dụng di động TopCV</a>
                                            </li>
                                            <li>
                                                <a href="">Tính lương Gross - Net</a>
                                            </li>
                                            <li>
                                                <a href="">Tính lãi suất kép</a>
                                            </li>
                                            <li>
                                                <a href="">Lập kế hoạch tiết kiệm</a>
                                            </li>
                                            <li>
                                                <a href="">Tính bảo hiểm thất nghiệp</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="infor-relate">
                                        <span>Phát triển bản thân</span>
                                        <ul>
                                            <li>
                                                <a href="">TopCV Contest</a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    <div class="infor-relate">
                                        <span>Xây dựng sự nghiệp</span>
                                        <ul>
                                            <li>
                                                <a href="">Việc làm tốt nhất</a>
                                            </li>
                                            <li>
                                                <a href="">Việc làm lương cao</a>
                                            </li>
                                            <li>
                                                <a href="">Việc làm quản lý</a>
                                            </li>
                                            <li>
                                                <a href="">Việc làm từ xa (remote)</a>
                                            </li>
                                            <li>
                                                <a href="">Việc làm bán thời gian</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="location-ahead-company">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="text-about-company">
                                        <span>© 2014 - 2022 <b>Công ty cổ phần TopCV Việt Nam</b></span>
                                        <br>
                                        <span>
                                            <b>Trụ sở HN:</b><br>
                                            Tầng 3, 4 tòa FS - GoldSeason số 47 Nguyễn Tuân, Thanh Xuân Trung, Thanh Xuân, Hà Nội
                                            <br>
                                            Trụ sở HCM: <br>
                                        </span>
                                        <br>
                                        <span>
                                            <b>Chi nhánh TP HCM:</b><br>
                                            Tầng 12, Tòa nhà Dali, 24C Phan Đăng Lưu, Phường 6, Quận Bình Thạnh, TP Hồ Chí Minh
                                        </span>
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="img-logo-company">
                                        <img src="../assets/image/Logo_TopCV_no_slogan.png" alt="">
                                    </div>
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
