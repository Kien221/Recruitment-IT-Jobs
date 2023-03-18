<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/public.css')}}">
    <link rel="stylesheet" href="{{asset('css/hr.css')}}">
    <link rel="stylesheet" href="{{asset('css/applicant.css')}}">
    <link rel="stylesheet" href="{{asset('js/js.js')}}">
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>NHÀ TUYỂN DỤNG</title>
</head>
<body>
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
                                        <span>Ứng viên {{$applicant_cv->name}} | Nguồn tuyendung.topcv.vn</span>
                                     </div> 
                                    <span class="close">
                                            <i class="fa-sharp fa-solid fa-xmark"></i>
                                    </span>
                                </div>
                            </div>
                       </div>
                       <div class="row" id="profile">
                           <div class="col-md-4" id="avatar_prefer_name">
                                <div class="avatar_prefer_name">
                                    <div class="avatar_name">
                                        <img src="{{asset('storage/'.$applicant_cv->avatar)}}" alt="">
                                        <h5>{{$applicant_cv->name}}</h5>
                                    </div>
                                    <div class="base_infor">
                                        <div class="infor_applicant">
                                            <i class="fa-solid fa-user"></i>
                                            <span>{{$applicant_cv->name}}</span>
                                        </div>
                                        <div class="infor_applicant">
                                            <i class="fa-sharp fa-solid fa-phone"></i>
                                            <span>{{$applicant_cv->phoneNumber}}</span>
                                        </div>
                                        <div class="infor_applicant email_applicant">
                                            <i class="fa-solid fa-envelope"></i>
                                            <span>{{$applicant_cv->email}}</span>
                                        </div>
                                        <div class="infor_applicant email_applicant">
                                            <i class="fa-solid fa-link"></i>
                                            <a href="{{$applicant_cv->links}}" target="blank" style="color:white">{{$applicant_cv->links}}</a>
                                        </div>
                                        <div class="introduce_yourself">
                                            <h5>GIỚI THIỆU BẢN THÂN</h5>
                                            @if($applicant_cv->introduce_yourself !== null)
                                            <div class="introduce_yourself">{!!$applicant_cv->introduce_yourself!!}</div>
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
                                       {!!$applicant_cv->study_degree!!}
                                    </div>
                                </div>
                                <div class="category experience">
                                    <div class="text_icon">
                                        <i class="fa-solid fa-briefcase"></i>
                                        <span>KINH NGHIỆM LÀM VIỆC</span>
                                    </div>
                                    <div class="show_detail">
                                       {!!$applicant_cv->experience!!}
                                    </div>
                                </div>
                                <div class="category work_skill">
                                    <div class="text_icon">
                                        <i class="fa-solid fa-tools"></i>
                                        <span>KỸ NĂNG LÀM VIỆC</span>
                                    </div>
                                    <div class="show_detail">
                                       
                                    </div>
                                </div>
                                <div class="category certificate">
                                    <div class="text_icon">
                                        <i class="fa-solid fa-certificate"></i>
                                        <span>CHỨNG CHỈ</span>
                                    </div>
                                    <div class="show_detail">
                                       
                                    </div>
                                </div>
                                <div class="category project">
                                    <div class="text_icon">
                                        <i class="fa-solid fa-project-diagram"></i>
                                        <span>DỰ ÁN</span>
                                    </div>
                                    <div class="show_detail">
                                    
                                    </div>
                                </div>
    
                            </div>
                           </div>
                       </div>
                    </div>
                </div>
</div>
</body>
</html>

