<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/public.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Đăng kí</title>
</head>
<body>
    <div class="sign_up_form">
        <div class="row">
            <div class="col-md-6">
                <div class="main_form_signup">
                    <div class="sign_up_logo">
                        <a href="../public_view/index.html">
                            <img src="../assets/image/Logo_TopCV_no_slogan.png" alt="">
                        </a>
                        
                    </div>
                    <h6>Chào mừng bạn đến với TopCV</h6>
                    <span class="sign_up_intro">Cùng xây dựng một hồ sơ nổi bật và nhận được các cơ hội sự nghiệp lý tưởng</span>
                    <form id="form" action="{{route('register.applicant')}}" class="form" method="POST">
                        @csrf
                        <div class="input">
                            <span>Họ và tên</span>
                            <br>
                            <input type="text" placeholder="Vui lòng nhập họ và tên" name="name">
                            <div class="validate-name" style="display:none">
                                <p style="color:red">Vui lòng nhập tên</p>
                            </div>
                        </div>
                        <div class="input">
                            <span>Email</span>
                            <br>
                            <input type="email" placeholder="Nhập email của bạn" name="email">
                            <div class="validate-email" style="display:none">
                                <p style="color:red">Email không được để trống</p>
                            </div>
                        </div>
                        <div class="input">
                            <span>Mật khẩu</span>
                            <br>
                            <input type="password" placeholder="Nhập mật khẩu" name="password">
                            <div class="validate-password" style="display:none">
                                <p style="color:red">Vui lòng mật khẩu</p>
                            </div>
                        </div>
                        <div class="input">
                            <span>Xác nhận mật khẩu</span>
                            <br>
                            <input type="password" placeholder="Nhập lại mật khẩu" name="confirm_password">
                            <div class="validate-confirm_password" style="display:none">
                                <p style="color:red">Vui lòng xác nhận mật khẩu</p>
                            </div>
                            <div class="validate-confirm_password_wrong" style="display:none">
                                <p style="color:red">Mật khẩu không khớp</p>
                            </div>
                        </div>
                        <p>Bằng việc đăng ký tài khoản, bạn đã đồng ý với <span>Điều khoản dịch vụ</span> và <span>Chính sách bảo mật</span> của chúng tôi</p>
                        <div class="sign_up_button">
                            <button type="submit">Đăng ký</button>
                        </div>
                    </form>
                        <div class="sign_up_footer">
                            <span>Bạn đã có tài khoản? <a href="{{route('login')}}">Đăng nhập ngay</a></span>
                        </div>
                    </div>
            </div>
            <div class="col-md-6">
                <div class="banner_intro">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
               
                                <div class="banner_singup">
                                    <img src="../assets/image/86abff643f29067301dd713716101cdd-6385bcbe4a011.jpg" alt="" class="img_hot_company">
                                    <h5>Công cụ viết CV đẹp Miễn phí</h5>
                                    <p>Nhiều mẫu CV đẹp, phù hợp nhu cầu ứng tuyển các vị trí khác nhau. Dễ dàng chỉnh sửa thông tin, tạo CV online nhanh chóng trong vòng 5 phút.</p>
                
                                </div>
                          </div>
                          <div class="carousel-item">
                     
                                <div class="banner_singup">
                                    <img src="../assets/image/86abff643f29067301dd713716101cdd-6385bcbe7f2ae.jpg" alt="" class="img_hot_company">
                                    <h5>Công cụ viết CV đẹp Miễn phí</h5>
                                    <p>Nhiều mẫu CV đẹp, phù hợp nhu cầu ứng tuyển các vị trí khác nhau. Dễ dàng chỉnh sửa thông tin, tạo CV online nhanh chóng trong vòng 5 phút.</p>
                                </div>

            
                          </div>
                          <div class="carousel-item">
                    
                                <div class="banner_singup">
                                    <img src="../assets/image/86abff643f29067301dd713716101cdd-6385bcbe9d214.jpg" alt="" class="img_hot_company">
                                    <h5>Công cụ viết CV đẹp Miễn phí</h5>
                                    <p>Nhiều mẫu CV đẹp, phù hợp nhu cầu ứng tuyển các vị trí khác nhau. Dễ dàng chỉnh sửa thông tin, tạo CV online nhanh chóng trong vòng 5 phút.</p>
                                </div>
             
                          </div>
                          
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="color: red;"></span>
                            <span class="sr-only">Next</span>
                          </a>
                      </div>
                    
                </div>
            </div>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            let form = $('#form');
            let name = $('input[name="name"]');
            let email = $('input[name="email"]');
            let password = $('input[name="password"]');
            let confirm_password = $('input[name="confirm_password"]');
            form.on('submit', function(e){
                    e.preventDefault();
                    if(name.val() == ''){
                        $(this).find('input[name="name"]').css('border', '1px solid red');
                        $('.validate-name').css('display','block')
                        
                    }
                    if(email.val() == ''){
                        $(this).find('input[name="email"]').css('border', '1px solid red');
                        $('.validate-email').css('display','block')
                        
                    }
                    if(password.val() == ''){
                        $(this).find('input[name="password"]').css('border', '1px solid red');
                        $('.validate-password').css('display','block')
                        
                    }
                    if(confirm_password.val() == ''){
                        $(this).find('input[name="confirm_password"]').css('border', '1px solid red');
                        $('.validate-confirm_password').css('display','block')
                        
                    }
                    if(password.val() != confirm_password.val()){
                        $(this).find('input[name="confirm_password"]').css('border', '1px solid red');
                        $('.validate-confirm_password_wrong').css('display','block') 
                    }
                    form.submit();
                });
        });
    </script>
</body>
</html>