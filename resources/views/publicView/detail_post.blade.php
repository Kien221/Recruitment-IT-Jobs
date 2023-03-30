<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/public.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/applicant.css')}}">
    <script src="{{asset('js/js.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>TopCv-{{$detail_post->title}}</title>
</head>
<body>
    @if(session('success_login_applicant'))
        @include('layout.applicantview.header')
    @elseif(session('success_login_hr'))
        @include('layout.hrview.public_header')
    @else
        @include('layout.publicview.header')
    @endif
    @include('layout.publicview.end_header')
    @if(session('apply_cv_success'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <strong>{{session('apply_cv_success')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if(session('apply_cv_error'))
    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <strong>{{session('apply_cv_error')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <div id="main-post_detail">
        <div class="container-fluid">
            <div class="row post_introduce">
                <div class="col-sm-9 post_company_introduce">   
                    <div class="img-post">
    
                        <img src="{{asset('storage/'.$detail_post->logo)}}" alt="">
                    </div>
                    <div class="describe_detail_post">
                        <h5>{{$detail_post->title}}</h5>
                        <a href="#">{{$detail_post->name}}</a>
                        <div class="time_apply">
                            <i class="fa-solid fa-clock"></i>
                            <span>Hạn nộp hồ sơ: {{$detail_post->expired_post}}</span>
                        </div>
                    </div>
                </div>
                @if(session('id_hr') == null)
                <div class="col-sm-3">
                    <div class="button-apply">
                        <i class="fa-sharp fa-solid fa-paper-plane"></i>
                        @if(session('id_applicant') != null)
                        <button onclick="show_apply_form()">ỨNG TUYỂN NGAY</button>
                        @else
                        <button><a href="{{route('login')}}" style="color:white;text-decoration:none;">ỨNG TUYỂN NGAY</a></button>
                        @endif
                    </div>
                    <div class="button-save_post">
                        <i class="fa-regular fa-heart"></i>
                        @if(session('id_applicant') != null)
                        <a href="#">LƯU TIN</a>
                        @else
                        <a href="{{route('login')}}">LƯU TIN</a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

        </div>
        <div class="about_company">
            <div class="container-fluid">
                <div class="row link-company">
                   <ul>
                    <li>
                        <a href="#" id="first_link">Tin Tuyển Dụng</a>
                    </li>
                    <li>
                        <a href="#infor_company">Thông Tin Công Ty</a>
                    </li>
                    <li>
                        <a href="#job_relate">Việc Làm Liên Quan</a>
                    </li>
                   </ul>
                </div>

            </div>
        </div>
        <div class="description-job">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="text_detail">Chi tiết tin tuyển dụng</h3>
                    <div class="main-info">
                        <span>Thông Tin Chung</span>
                        <div class="row">
                            <div class="col-md-6 info">
                                <ul>
                                    <li>
                                        <div class="infor-icon">
                                            <i class="fa-solid fa-money-bill"></i>
                                        </div>
                                        <div class="infor-content">
                                            <span>Mức lương</span>
                                            <br>
                                            <span class="btn_language" style="color:white;">{{$detail_post->min_salary}} {{$detail_post->unit_money}} - {{$detail_post->max_salary}} {{$detail_post->unit_money}}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="infor-icon">
                                            <i class="fa-sharp fa-solid fa-briefcase"></i>
                                        </div>
                                        <div class="infor-content">
                                            <span>Hình thức làm việc</span>
                                            <br>
                                            <span class="btn_language" style="color:white;">{{$detail_post->work_type}}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="infor-icon">
                                            <i class="fa-solid fa-code"></i>
                                        </div>
                                        <div class="infor-content">
                                            <span>Ngôn ngữ</span>
                                            <br>
                                            @foreach(json_decode($detail_post->languages) as $language)
                                            <span class="btn_language" style="color:white;">{{$language}}</span>
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 info">
                                <ul>
                                    <li>
                                        <div class="infor-icon">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <div class="infor-content">
                                            <span>Số Lượng Tuyển</span>
                                            <br>
                                            <span class="btn_language" style="color:white;">{{$detail_post->number_of_recruitment}}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="infor-icon">
                                            <i class="fa-sharp fa-solid fa-briefcase"></i>
                                        </div>
                                        <div class="infor-content">
                                            <span>Vị trí</span>
                                            <br>
                                            @foreach(json_decode($detail_post->position) as $position)
                                            <span class="btn_language" style="color:white;">{{$position}}</span>
                                            @endforeach
                                        </div>
                                    </li>
                                    <li>
                                        <div class="infor-icon">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div class="infor-content">
                                            <span>Địa điểm làm việc</span>
                                            <br>
                                            <span class="btn_language" style="color:white;"> {{$detail_post->district}}- {{$detail_post->city}}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="detail-job">
                        <h5 class="text_category-job">Mô tả công việc</h5>
                        <div class="text-describe-job">
                           {!!$detail_post->description!!}
                        </div>
                        <h5 class="text_category-job">Yêu Cầu Ứng Viên</h5>
                        <div class="text-describe-job">
                           {!!$detail_post->requirement!!}
                        </div>
                        <h5 class="text_category-job">Quyền Lợi Được Hưởng</h5>
                        <div class="text-describe-job">
                            {!!$detail_post->benefit!!}
                        </div>
                    </div>
                    @if(session('id_hr') == null)
                    <div class="way-apply">
                        <h5>Cách thức ứng tuyển</h5>
                        <p>Ứng viên nộp hồ sơ trực tuyến bằng cách bấm <span>Ứng tuyển ngay </span>dưới đây.</p>
                    @if(session('id_applicant') == null)
                        <div class="apply-press">
                            <button id="apply_btn"><a href="{{route('login')}}">ỨNG CỬ NGAY</a></button>
                            <button><a href="{{route('login')}}">LƯU TIN</a></button>
                        </div>
                    @else
                        <div class="apply-press">
                            <button id="apply_btn" style="color:white;"onclick="show_apply_form()">ỨNG TUYỂN NGAY</button>
                            <button><a href="#">LƯU TIN</a></button>
                        </div> 
                    @endif
                    </div>
                    @endif
                    <p class="time-apply">Hạn nộp hồ sơ : {{$detail_post->expired_post}}</p>
                    <div class="attention">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <p>Báo cáo tin tuyển dụng: Nếu bạn thấy rằng tin tuyển dụng này không đúng hoặc có dấu hiệu lừa đảo, <a href="#">hãy phản ánh với chúng tôi</a>.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="report_share_social">
                        <div class="share_social">
                            <span>Chia sẻ tin tuyển dụng</span>
                            <p>Sao chép đường dẫn</p>
                            <div class="link">
                                <span class="url_post">https://www.topcv.vn/viec-lam/se</span>
                                <div class="link_icon"><i class="fa-solid fa-link"></i></div>
                            </div>
                            <p>Chia sẻ qua mạng xã hội</p>
                            <div id="social">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="youtube_icon"><i class="fa-brands fa-youtube"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="report_post">
                            <span>Báo cáo tin tuyển dụng</span>
                            <p>Nếu bạn thấy rằng tin tuyển dụng này không đúng hoặc có một trong các dấu hiệu sau, hãy phản ánh với chúng tôi.</p>
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                  <div class="carousel-item active">
                                    <img src="{{asset('image/2.jpg')}}" class="d-block w-100" alt="...">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="{{asset('image/330x290_KICC_banner_2022.jpg')}}" class="d-block w-100" alt="...">
                                  </div>
                                  <div class="carousel-item">
                                    <img src="{{asset('image/f689473b80c0a189ee8ba4fae1f8cd66-WgsOe.jpg')}}" class="d-block w-100" alt="...">
                                  </div>
                            </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                    </button>
                            </div>
                            @if(session('id_hr') == null)
                              <div class="report_btn">
                                    <a href="#">Báo Cáo Tin Tuyển Dụng</a>
                              </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="infor_company" id="infor_company">
            <div class="header_infor_company">
                <h3 class="text_detail">Thông tin {{$detail_post->name}}</h3>
                <span><a href="#">Xem trang công ty <i class="fa-solid fa-location-arrow"></i></a> </span>
            </div>
            <div class="slide_img_company">
                <div class="row">
                    @foreach($images_company as $image_company)
                    <div class="col-md-4">
                        <div class="img_company">
                            <img src="{{asset('storage/'.$image_company->image)}}" alt="">
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="describe_company">
                    <ul>
                        <li>
                            <div class="infor-icon introduce">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <div class="infor-content">
                                <span>Giới thiệu</span>
                                <br>
                                <span>{!!$detail_post->description_company!!}</span>
                            </div>
                        </li>
                        <li>
                            <div class="infor-icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="infor-content">
                                <span> Quy Mô</span>
                                <br>
                                <span>{{$detail_post->number_of_employees}}</span>
                            </div>
                        </li>
                        <li>
                            <div class="infor-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="infor-content">
                                <span>Địa điểm</span>
                                <br>
                                <span>{{$detail_post->address}}</span>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
        

        </div>
        <div class="job_relate" id="job_relate">
            <h3 class="text_detail">Việc Làm Liên Quan</h3>
            <div class="post_relate">
                <div class="row post_company">
                    <div class="col-md-9">
                        <div class="list_posts">
                        </div>
                    </div>
                    <div class="col-md-3 introduce_banner">
                        <div class="introduce_new_company">
                            <h4> Có thể bạn quan tâm</h4>
                            <div class="post_introduce_company">
                                <div class="img_introduce-company">
                                    <img src="{{asset('storage/'.$review_company->company_logo)}}" alt="">
                                </div>
                                <div class="detail_introduce_company">
                                    <div class="name_company">
                                        <a href="{{route('post.detail',[$review_company->id,$review_company->slug])}}">{{$review_company->company_name}}</a>
                                    </div>
                                    <div class="describe">
                                        <a href="{{route('post.detail',[$review_company->id,$review_company->slug])}}">{{$review_company->title}}</a>
                                        <div class="salary-time_post">
                                                <span><i class="fa-solid fa-money-bill-1-wave"></i>{{$review_company->min_salary}}-{{$review_company->max_salary}}{{$review_company->unit_money}}</span>
                                                <span><i class="fa-sharp fa-solid fa-clock"></i>{{$review_company->expired_post}}</span>
                                        </div>
                                        <div class="detail">
                                            <button>
                                                <a href="#">
                                                Tìm hiểu ngay
                                                 </a>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="banner_web">
                                <img src="{{asset('image/pasted image 0.png')}}" alt="">
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
                            <img src="../assets/image/logo-td.png" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-apply" id="form-apply">
        <div class="content-form">
            <div class="job_apply">
                <h4><span>Ứng tuyển</span> <a href="#"> {{$detail_post->title}}</a></h4>
                <span class="close" onclick="close_apply_form()">
                    <i class="fa-sharp fa-solid fa-xmark"></i>
                </span>
            </div>
            @if(session()->get('id_applicant') != null)
            <div class="method-apply">
                <form action="{{route('apply.cv',[$detail_post->post_id,session()->get('id_applicant')])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-7">
                            <div class="choice_method">
                                <span><b>Chọn CV online:</b> <i>khuyến khích</i></span>
                                <br>
                                <br>
                                <div id="choice_profile_cv">
                                    <div class="or">
                                        <span class="or">Hoặc</span>
                                    </div>
                                    <br>
                                    <input type="radio" id="check" name="type_cv" value="cv_web">
                                    <span class="cv_online">Chọn hồ sơ online <a href="../applicant_view/index.html" target="_blank">(Xem)</a></span>
                                    <br>
                                    <span class="attend">Hồ sơ chưa hoàn thiện. Vui lòng cập nhật <a href="../applicant_view/edit_cv_profile.html"> Tại đây</a></span>
        
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="upfile" id="upfile">
                                <label for="up_cv" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i> Tải CV lên từ máy tính(PDF)
                                </label>
                                <input type="file" id="up_cv" name="file_cv">
                                <span class="remove_img_cv" id="remove_img_cv">
                                        <i class="fa-sharp fa-solid fa-xmark"></i>
                                </span>
                                <embed src="" alt="" id="img_cv" >
                            </div>
                        </div>
                    </div>
                    <div class="hope">
                        <h5><b>Thư giới thiệu:</b></h5>
                        <textarea name="brief_introduce" id="text_hope_to_apply" cols="96" rows="3" placeholder="Viết giới thiệu ngắn gọn về bản thân (điểm mạnh, điểm yếu) và nêu rõ mong muốn, lý do làm việc tại công ty này. Đây là cách gây ấn tượng với nhà tuyển dụng nếu bạn có chưa có kinh nghiệm làm việc (hoặc CV không tốt)."></textarea>
                    </div>
                    <div class="button">
                        <button class="close_btn" onclick="close_apply_form()"> Đóng lại</button>
                        <button class="send_btn">Nộp CV</button>
                    </div>
                </form>

                <div class="warning">
                    <span><i class="fa-solid fa-triangle-exclamation"></i> Lưu ý:</span>
                    <div class="warning_text">
                        1. Ứng viên nên lựa chọn ứng tuyển bằng CV Online & viết thêm mong muốn tại phần thư giới thiệu để được Nhà tuyển dụng xem CV sớm hơn.
                    </div>
                    <div class="warning_text">
                        2. Để có trải nghiệm tốt nhất, bạn nên sử dụng các trình duyệt phổ biến như Google Chrome hoặc Firefox.
                    </div>
                    <div class="warning_text important">
                        3. Trước tình trạng gia tăng các hình thức lừa đảo việc làm trên internet được các cơ quan chức năng cảnh báo, TopCV xin lưu ý bạn một số dấu hiệu lừa đảo việc làm như sau:
                    </div>

                    <div class="warning_text">
                        TopCV không chịu trách nhiệm về việc ứng viên tham gia ứng tuyển - đi làm và bị mất tiền vì bất cứ lý do gì, chúng tôi mong bạn thực sự cảnh giác trước những lời mời nạp tiền vào các ứng dụng hoặc nộp tiền trực tiếp cho nhà tuyển dụng. Trường hợp cần hỗ trợ, vui lòng Báo cáo tin tuyển dụng hoặc thông báo tới TopCV qua email <span class="email">kienb1910088@student.ctu.edu.vn</span>
                    </div>
                </div>
            </div>
            @endif
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click','.list_posts>nav>ul a', function(e){
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1]
                record_posts(page)
                })
                function record_posts(page){
                    $.ajax({
                        url:'{{route('ajax.paginate.detail_page')}}?page='+page,
                        success:function(res){
                            $('.list_posts').html(res);
                        },
                        error:function(err){
                            console.log(err);
                        }
                    })
            };
            $.ajax({
                url:'{{route('ajax.get.all.jobs.randoms')}}',
                success:function(res){
                    console.log(res);
                    $('.list_posts').html(res);
                },
                error:function(err){
                    console.log(err);
                }
           });
        });
    </script>
</body>
</html>