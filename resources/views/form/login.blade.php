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
                        <a href="{{asset('home')}}">
                            <img src="{{asset('image/Logo_TopCV_no_slogan.png')}}" alt="">
                        </a>
                        
                    </div>
                    <h6>Chào mừng bạn trở lại với TopCV</h6>
                    <span class="sign_up_intro">Cùng xây dựng một hồ sơ nổi bật và nhận được các cơ hội sự nghiệp lý tưởng</span>
                    <div class="form">
                        <div class="input">
                            <span>Email</span>
                            <br>
                            <input type="email" placeholder="Nhập email của bạn">
                        </div>
                        <div class="input">
                            <span>Mật khẩu</span>
                            <br>
                            <input type="password" placeholder="Nhập mật khẩu">
                        </div>
                    </div>
                    
                    <div class="sign_up_button">
                        <button type="submit">Đăng nhập</button>
                    </div>
                    <div class="different">Hoặc</div>
                    <div class="login_social">
                        <div class="social github">
                            <a href="{{route('auth.github','github')}}">
                                <i class="fab fa-github"></i>
                                Github
                            </a>
                        </div>
                        <div class="social google">
                            <a href="">
                                <i class="fab fa-google"></i>
                                Google
                            </a>
                        </div>
                        <div class="social facebook">
                            <a href="">
                                <i class="fab fa-facebook-f"></i>
                                Facebook
                            </a>
                        </div>
                    </div>
                    <div class="sign_up_footer">
                        <span>Bạn chưa tài khoản? 
                            <a href="resignation.html"> Đăng kí ngay</a>
                            <a href="#" class="forget_password">Quên mật khẩu</a>
                        </span>
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
</body>
</html>