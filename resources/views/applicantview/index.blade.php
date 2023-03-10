<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{asset('css/applicant.css')}}">
    <link rel="stylesheet" href="{{asset('css/public.css')}}">
    <script src="{{asset('js/js.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ỨNG CỬ VIÊN</title>
</head>
<body>
    @include('layout.applicantview.header')
    <div id="main_profile">
       @include('layout.applicantview.navbar_profile')
        <div class="container-fluid">
            <div class="row">
                 @if($user->perfection_level < 40)
                 <div class="col-md-9">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Thông báo!</h4>
                        <p>CV của bạn chưa hoàn thiện, vui lòng điều chỉnh CV để có thể ứng tuyển công việc.</p>
                        <hr>
                        <p class="mb-0">Hoàn thành CV <a href="{{route('applicantView')}}">tại đây</a></p>
                     </div>
                </div>
                @else
                <div class="col-md-9">
                    <div class="header_profile">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="header_logo">
                                    <img src="{{asset('image/Logo_TopCV_no_slogan.png')}}" alt="">
                                 </div>  
                            </div>
                            <div class="col-md-9">
                                <div class="header_text">
                                    <h4>NỀN TẢNG TUYỂN DỤNG NHÂN SỰ HÀNG ĐẦU VIỆT NAM</h4>
                                    <span>Ứng viên {{$user->name}} | Nguồn tuyendung.topcv.vn</span>
                                 </div> 
                            </div>
                        </div>
                   </div>
                   <div class="row" id="profile">
                       <div class="col-md-4" id="avatar_prefer_name">
                            <div class="avatar_prefer_name">
                                <div class="avatar_name">
                                    <img src="{{asset('storage/'.$user->avatar)}}" alt="">
                                    <h5>{{$user->name}}</h5>
                                </div>
                                <div class="base_infor">
                                    <div class="infor_applicant">
                                        <i class="fa-solid fa-user"></i>
                                        <span>{{$user->name}}</span>
                                    </div>
                                    <div class="infor_applicant">
                                        <i class="fa-sharp fa-solid fa-phone"></i>
                                        <span>{{$user->phoneNumber}}</span>
                                    </div>
                                    <div class="infor_applicant email_applicant">
                                        <i class="fa-solid fa-envelope"></i>
                                        <span>{{$user->email}}</span>
                                    </div>
                                    <div class="introduce_yourself">
                                        <h5>GIỚI THIỆU BẢN THÂN</h5>
                                        @if($user->introduce_yourself !== null)
                                        <div class="introduce_yourself">{!!$user->introduce_yourself!!}</div>
                                        @else
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="down">
                                <a href="#">Tải xuống CV</a>
                            </div> -->
                       </div>
                       <div class="col-md-8" id="detail_cv">
                        <div class="detail_cv">
                            <div class="category study">
                                <div class="text_icon">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    <span>HỌC VẤN</span>
                                </div>
                                <div class="show_detail">
                                   {!!$user->study_degree!!}
                                </div>
                            </div>
                            <div class="category experience">
                                <div class="text_icon">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span>KINH NGHIỆM LÀM VIỆC</span>
                                </div>
                                <div class="show_detail">
                                    {!!$user->experience!!}
                                </div>
                            </div>
                            <div class="category work_skill">
                                <div class="text_icon">
                                    <i class="fa-solid fa-tools"></i>
                                    <span>KỸ NĂNG LÀM VIỆC</span>
                                </div>
                                <div class="show_detail">
                                   {{$user->work_skill}}
                                </div>
                            </div>
                            <div class="category certificate">
                                <div class="text_icon">
                                    <i class="fa-solid fa-certificate"></i>
                                    <span>CHỨNG CHỈ</span>
                                </div>
                                <div class="show_detail">
                                    ● Perform a mix of new software development, enhancements and defect resolution as required
                                    <br>
                                    ● Build and Implement project applications according to design specifications
            
                                    ● Research technical issues and provide recommendations to enhance company websites
                                    <br>
                                    ● Work with external partners in the design and development of software solutions
                                    <br>
                                    ● Work as a team with other development staff in Magento and JavaScript related technologies
                                    <br>
                                </div>
                            </div>
                            <div class="category project">
                                <div class="text_icon">
                                    <i class="fa-solid fa-project-diagram"></i>
                                    <span>DỰ ÁN</span>
                                </div>
                                <div class="show_detail">
                                    ● Perform a mix of new software development, enhancements and defect resolution as required
                                    <br>
                                    ● Build and Implement project applications according to design specifications
            
                                    ● Research technical issues and provide recommendations to enhance company websites
                                    <br>
                                    ● Work with external partners in the design and development of software solutions
                                    <br>
                                    ● Work as a team with other development staff in Magento and JavaScript related technologies
                                    <br>
                                </div>
                            </div>

                        </div>
                       </div>
                   </div>
                </div>
                @endif
                <div class="col-md-3">
                    <div class="manager_status_cv">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="check_allow" checked>
                            <label class="form-check-label" for="check_allow">Trạng thái tìm việc đang bật</label>
                          </div>
                        
                        <p>Bật tìm việc để nhận được nhiều cơ hội việc làm tốt nhất từ TopCV</p>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="check" checked>
                            <label class="form-check-label-allow" for="check">Cho phép NTD liên hệ bạn qua</label>
                        </div>
                        <div class="choice_cv">
                            <div class="cv_online">
                                <input type="radio" checked>
                                <span>CV Online</span>
                            </div>
                            <div class="profile_cv">
                                <input type="radio" >
                                <span>TopCV Profile</span>
                            </div>
                        </div>
                        <div class="remind">
                            <span>
                                TopCV Profile của bạn đang hoàn thiện dưới 70%, vui lòng cập nhật thêm thông tin hoặc chọn CV Online để Nhà tuyển dụng có thể tiếp cận bạn
                            </span>
                        </div>
                    </div>
                    <div class="list_company_viewed">
                        <h5>Ai đã xem hồ sơ của bạn</h5>
                        <ul>
                            <li>
                                <div class="company">
                                    <div class="logo_company_viewed">
                                        <img src="../assets/image/2.jpg" alt="">
                                    </div>
                                    <div class="name">
                                        <a href="#">TopCV</a>
                                        <div class="time_viewed">1 giờ trước</div>
                                    </div>
                                </div>

                            </li>
                            <li>
                                <div class="company">
                                    <div class="logo_company_viewed">
                                        <img src="../assets/image/2.jpg" alt="">
                                    </div>
                                    <div class="name">
                                        <a href="#">TopCV</a>
                                        <div class="time_viewed">1 giờ trước</div>
                                    </div>
                                </div>

                            </li>
                            <li>
                                <div class="company">
                                    <div class="logo_company_viewed">
                                        <img src="../assets/image/2.jpg" alt="">
                                    </div>
                                    <div class="name">
                                        <a href="#">TopCV</a>
                                        <div class="time_viewed">1 giờ trước</div>
                                    </div>
                                </div>
 
                            </li>
                            <li>
                                <div class="company">
                                    <div class="logo_company_viewed">
                                        <img src="../assets/image/2.jpg" alt="">
                                    </div>
                                    <div class="name">
                                        <a href="#">TopCV</a>
                                        <div class="time_viewed">1 giờ trước</div>
                                    </div>
                                </div>

                            </li>
                            <li>
                                <div class="company">
                                    <div class="logo_company_viewed">
                                        <img src="../assets/image/2.jpg" alt="">
                                    </div>
                                    <div class="name">
                                        <a href="#">TopCV</a>
                                        <div class="time_viewed">1 giờ trước</div>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>
                    <div class="banner">
                        <img src="../assets/image/pasted image 0.png" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="footer">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
    var checked = true;
    $('#check_allow').click(function(){
        if(checked == true){
            $('#check_allow').prop('checked', false);
            $('.form-check-label').html('');
            $('.form-check-label').append('<label class="form-check-label" for="check_allow" style=" font-size: 16px;font-weight: 600; color: #e74c3c;">Trạng thái tìm việc đang tắt</label>');
            checked = false;
        }else{
            $('#check_allow').prop('checked', true);
            $('.form-check-label').html('');
            $('.form-check-label').append('<label class="form-check-label" style=" font-size: 16px;font-weight: 600;color: #00b14f;" for="check_allow">Đã bật trạng thái tìm việc</label>');
            checked = true;
        }
    });
    $('#check').click(function(){
        if(checked == true){
            $('#check').prop('checked', false);
            $('.form-check-label-allow').html('');
            $('.form-check-label-allow').append('<label class="form-check-label-allow" style=" font-size: 16px;font-weight: 600; color: #e74c3c;"  for="check">Cho phép NTD liên hệ bạn qua</label>');
            $('.choice_cv').hide();
            checked = false;
        }else{
            $('#check').prop('checked', true);
            $('.form-check-label-allow').html('');
            $('.form-check-label-allow').append('<label class="form-check-label-allow" for="check" style=" font-size: 16px;font-weight: 600;color: #00b14f;">Cho phép NTD liên hệ bạn qua</label>');
            $('.choice_cv').show();
            checked = true;
        }   
    });

    var list_link = document.querySelectorAll('.link_profile');
    console.log(list_link);
    for(var i = 0;i<list_link.length;i++){
        list_link[i].addEventListener('click',function(){
            list_link[i].style.backgroundColor = "red";
        });
    }

});
    </script>
</body>
</html>