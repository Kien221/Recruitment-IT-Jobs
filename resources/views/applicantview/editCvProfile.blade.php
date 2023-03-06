<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="{{asset('css/applicant.css')}}">
    <link rel="stylesheet" href="{{asset('css/public.css')}}">
    <script src="{{asset('js/js.js')}}"></script> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ỨNG CỬ VIÊN</title>
</head>
<body>
   @include('layout.applicantview.header')  
    <div id="main_profile">
    @include('layout.applicantview.navbar_profile')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="nav_edit_cv">
                        <ul class="list_nav_edit_cv">
                            <li>
                                <div class="edit_item">
                                    <a href="#infor_yourself">
                                        <i class="fa-solid fa-user"></i>
                                        <span>Thông tin cá nhân</span>

                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="edit_item">
                                    <a href="#your_hooby">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        <span>Giới thiệu bản thân</span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="edit_item">
                                    <a href="#your_study">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                        <span>Học vấn</span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="edit_item">
                                    <a href="#your_exp">
                                        <i class="fa-solid fa-briefcase"></i>
                                        <span>Kinh nghiệm làm việc</span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <div class="edit_item">
                                    <a href="#language_skill">
                                        <i class="fa-solid fa-language"></i>
                                        <span>Kỹ năng lập trình</span>
                                    </a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="main_edit_profile">
                        <form action="{{route('update.cv.applicant',$cv_user->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="infor_yourself" id="infor_yourself">
                                <h5 class="title_edit_form"><i class="fa-solid fa-user"></i> THÔNG TIN CÁ NHÂN </h5>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="infor_input">
                                                <div class="col-md-3">Họ và tên</div>
                                                <div class="col-md-1">
                                                    <span class="required">(*)</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" placeholder="Vui lòng nhập họ tên" value="{{$cv_user->name}}" name="name">
                                                </div>
                                            </div>
                                            <div class="infor_input">
                                                <div class="col-md-3">Email</div>
                                                <div class="col-md-1">
                                                    <span class="required">(*)</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" placeholder="{{$cv_user->email}}" id="email_applicant" disabled>
                                                </div>
                                            </div>
                                            <div class="infor_input">
                                                <div class="col-md-3">Điện thoại</div>
                                                <div class="col-md-1">
                                                    <span class="required">(*)</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" placeholder="Vui lòng nhập số điện thoại" name="phoneNumber" value="{{$cv_user->phoneNumber}}">
                                                </div>
                                            </div>
                                            <div class="infor_input">
                                                <div class="col-md-3">Giới tính</div>
                                                <div class="col-md-1">
                                                    <span class="required">(*)</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="gender" id="" class="gender_select" value="{{$cv_user->gender}}">
                                                        <option value="Nam">Nam</option>
                                                        <option value="Nữ">Nữ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="infor_input">
                                                <div class="col-md-3">Thành Phố</div>
                                                <div class="col-md-1">
                                                    <span class="required">(*)</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="city">
                                                        <select class="form-control" id="select-city" name="city" required="required"> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <h6 class="choice_img_text">CHỌN ẢNH ĐẠI DIỆN</h6>
                                            <div class="upload_img_avatar">
                                                <div class="avatar_upload">
                                                    <img src="{{asset('storage/'.$cv_user->avatar)}}" alt="" name="avatar" id="avatar">
                                                </div>
                                                <div class="">
                                                    <input type="file" name="avatar" id="avatar_upload">
                                                    <label for="avatar_upload" class="lable_upload_avatar">Tải ảnh lên</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="infor_input">
                                            <div class="col-md-3">
                                                Địa chỉ cụ thể
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="Nhập địa chỉ cụ thể" name="address" value="{{$cv_user->address}}">
                                            </div>
                                        </div>
                                        <div class="infor_input">
                                            <div class="col-md-3">
                                                Link
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="https://github.com/username" name="links" value="{{$cv_user->links}}">
                                            </div>
                                        </div>
                                    </div>
                                    <p class="warning_text">Chú ý: không được để trống các thông tin bắt buộc có kí tự (*)</p>
                                <!-- <form action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="infor_input">
                                                <div class="col-md-3">Họ và tên</div>
                                                <div class="col-md-1">
                                                    <span class="required">(*)</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="hidden" value="{{$cv_user->id}}" id="applicant_id">
                                                    <input type="text" placeholder="Vui lòng nhập họ tên" value="{{$cv_user->name}}" name="name" id="name">
                                                </div>
                                            </div>
                                            <div class="infor_input">
                                                <div class="col-md-3">Email</div>
                                                <div class="col-md-1">
                                                    <span class="required">(*)</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" placeholder="{{$cv_user->email}}">
                                                </div>
                                            </div>
                                            <div class="infor_input">
                                                <div class="col-md-3">Điện thoại</div>
                                                <div class="col-md-1">
                                                    <span class="required">(*)</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" placeholder="Vui lòng nhập số điện thoại" name="phoneNumber" value="{{$cv_user->phoneNumber}}" id="phoneNumber">
                                                </div>
                                            </div>
                                            <div class="infor_input">
                                                <div class="col-md-3">Giới tính</div>
                                                <div class="col-md-1">
                                                    <span class="required">(*)</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <select name="gender" id="" class="gender_select" value="{{$cv_user->gender}}" id="gender">
                                                        <option value="">Nam</option>
                                                        <option value="">Nữ</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="infor_input">
                                                <div class="col-md-3">Thành Phố</div>
                                                <div class="col-md-1">
                                                    <span class="required">(*)</span>
                                                </div>
                                                <div class="col-md-8">
                                                    <input type="text" name="city_id" list="cityname" placeholder="Chọn thành phố" >
                                                        <datalist id="cityname" class="datalist" >
                                                            <option value="Boston">
                                                            <option value="Cambridge">
                                                        </datalist>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <h6 class="choice_img_text">CHỌN ẢNH ĐẠI DIỆN</h6>
                                            <div class="upload_img_avatar">
                                                <div class="avatar_upload">
                                                    <img src="{{asset('storage/'.$cv_user->avatar)}}" alt="" name="avatar">
                                                </div>
                                                <div class="">
                                                    <input type="file" name="avatar" id="avatar">
                                                    <label for="avatar" class="lable_upload_avatar">Tải ảnh lên</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="infor_input">
                                            <div class="col-md-3">
                                                Địa chỉ cụ thể
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="Nhập địa chỉ cụ thể" name="address" id="address" value="{{$cv_user->address}}">
                                            </div>
                                        </div>
                                        <div class="infor_input">
                                            <div class="col-md-3">
                                                Link
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" placeholder="https://github.com/username" name="links" id="links" value="{{$cv_user->links}}">
                                            </div>
                                        </div>
                                    </div>
                                    <p class="warning_text">Chú ý: không được để trống các thông tin bắt buộc có kí tự (*)</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="btn_save_edit">
                                                <button  type="button" onclick="infor_update()">Lưu</button>
                                            </div>
                                        </div>
                                    </div>
                                </form> -->
                            </div>
                            <div class="introduce_yourself_form hooby" id="your_hooby">
                                <h5 class="title_edit_form"><i class="fa-regular fa-pen-to-square"></i> GIỚI THIỆU BẢN THÂN </h5>
                                    <textarea name="introduce_yourself" id="introduce_yourself" rows="10"  placeholder="giới chịu đôi chút về bản thân VD( nơi sinh, tuổi tác, đam mê nghề nghiệp như nào, sở thích)">
                                        <div>
                                        {{$cv_user->introduce_yourself}}
                                        </div>
                                    </textarea>
                                    <script>
                                        CKEDITOR.replace( 'introduce_yourself' );
                                    </script>
                            </div>
                            <div class="introduce_yourself_form hooby" id="your_study">
                                <h5 class="title_edit_form"><i class="fa-solid fa-graduation-cap"></i></i> HỌC VẤN </h5>
                                    <textarea name="study_degree" id="study_degree" rows="10" placeholder="giới chịu đôi chút về bản thân VD( nơi sinh, tuổi tác, đam mê nghề nghiệp như nào, sở thích)">
                                        <div>
                                        {{$cv_user->study_degree}}
                                        </div>
                                    </textarea>
                                    <script>
                                        CKEDITOR.replace( 'study_degree' );
                                    </script>

                            </div>
                            <div class="introduce_yourself_form exp" id="your_exp">
                                <h5 class="title_edit_form"><i class="fa-solid fa-briefcase"></i> KINH NGHIỆM LÀM VIỆC </h5>
                                    <textarea name="experience" id="experience" rows="10" placeholder="giới chịu đôi chút về bản thân VD( nơi sinh, tuổi tác, đam mê nghề nghiệp như nào, sở thích)">
                                        <div>
                                        {{$cv_user->experience}}
                                        </div>
                                    </textarea>
                                    <script>
                                        CKEDITOR.replace( 'experience' );
                                    </script>

                            </div>
                            <div class="introduce_yourself_form language_skill" id="language_skill">
                                <h5 class="title_edit_form"><i class="fa-solid fa-graduation-cap"></i> KỸ NĂNG LẬP TRÌNH </h5>
                                    <textarea name="language_skill" id="language_skill" rows="10" cols="80">
                                        <div>
                                        {{$cv_user->language_skill}}
                                        </div>
                                    </textarea>
                                    <script>
                                        CKEDITOR.replace( 'language_skill' );
                                    </script>
                            </div> 
                            <div class="row">
                            <div class="col-md-12 btn_save">
                                <div class="btn_save_edit">
                                    <button type="submit">Lưu</button>
                                </div>
                            </div>
                            </div>
                        </form>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script >
        $(document).ready(async function(){
            $('#avatar_upload').change(function(){
            let file = $(this).prop('files')[0];
            let reader = new FileReader();
            reader.onload = function(){
                $('#avatar').attr('src',reader.result);
            }
            reader.readAsDataURL(file);
        })
            $('#select-city').select2();
            const response = await fetch('{{asset('locations/index.json')}}');
            const cities = await response.json();
            $.each(cities, function (index, each){
                $('#select-city').append(`
                <option value='${index}' data-path='${each.file_path}'>${index}</option>
                `);
            })
        });
    </script>

</body>
</html>