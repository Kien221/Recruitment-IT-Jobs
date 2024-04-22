@section('title')- {{'Nhà Tuyển Dụng'}} @endsection
@include('layout.hrview.header_hr')
<div class="main_hr_view">
    <div class="row">
        @include('layout.hrview.sidebar_hr')
        <div class="col-md-10">
            <div class="buy-service-header">
                <h5 class="buy-service-header-text">Mua dịch vụ</h5>
            </div>
            <div class="list-service">
                <div class="container">
                    <div class="row">
                    @foreach($packages_service as $package_service)
                        <div class="col-md-4">
                            <div class="service-item">
                                <div class="introduce_new_company">
                                    <div class="post_introduce_company">
                                        <div class="img_introduce-company">
                                            <img src="../assets/image/f689473b80c0a189ee8ba4fae1f8cd66-WgsOe.jpg" alt="">
                                        </div>
                                        <div class="detail_introduce_company">
                                            <div class="name_company">
                                                <a href="#">{{$package_service->name}}</a>
                                            </div>
                                            <div class="describe">
                                                <a href="#" style="color:red;font-size:20px;font-weight:600">{{number_format($package_service->price)}} VND</a>
                                                <div class="salary-time_post" style="padding:5px;margin-top:-5px">
                                                 <span style="font-size:16px">{{$package_service->introduce_service}}</span>
                                                </div>
                                                <div>
                                                    
                                                </div>
                                                <div class="salary-time_post">
                                                    <span><i class="fa-solid fa-check"></i> Thời gian hiệu lực</span>
                                                    <span>{{$package_service->expired_service}} </span>
                                                </div>
                                                <div class="salary-time_post">
                                                    <span><i class="fa-solid fa-check"></i> Số lượt tìm kiếm/ngày</span>
                                                    <span>{{$package_service->view_every_day}}</span>
                                                </div>
                                                <div class="salary-time_post">
                                                    <span><i class="fa-solid fa-check"></i> Số lượt xem CV/ngày</span>
                                                    <span> {{$package_service->search_every_day}} </span>
                                                </div>
                                                <div class="salary-time_post">
                                                    <span><i class="fa-solid fa-check"></i> Khung viền cho bài post</span>
                                                    <span><i class="fa-solid fa-check"></i></span>
                                                </div>
                                                <div class="salary-time_post">
                                                    <span style="margin: left -27px;px"><i class="fa-solid fa-check"></i> công ty nổi bật</span>
                                                    <span style="margin-right:-32px"><i class="fa-solid fa-check"></i></span>
                                                </div>
                                                <div class="detail">
                                                    <button>
                                                        <a href="{{route('cart_service_view',$package_service->id)}}">
                                                            Mua ngay
                                                        </a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        </div>
                                    </div>

                                </div>
                        </div>
                    @endforeach
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
                                        Tầng 3, 4 tòa FS - GoldSeason số 47 Nguyễn Tuân, Thanh Xuân Trung, Thanh Xuân,
                                        Hà Nội
                                        <br>
                                        Trụ sở HCM: <br>
                                    </span>
                                    <br>
                                    <span>
                                        <b>Chi nhánh TP HCM:</b><br>
                                        Tầng 12, Tòa nhà Dali, 24C Phan Đăng Lưu, Phường 6, Quận Bình Thạnh, TP Hồ Chí
                                        Minh
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