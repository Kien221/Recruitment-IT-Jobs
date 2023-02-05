<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/public.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/applicant.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Tuyển dụng IT</title>
</head>
<body>
    @if(session('success_login'))
    @include('layout.applicantview.header')
    <div class="end-header">
               
               <div class="row">
                   <div class="col-md-4">
                       <div class="search-input">
                           <input type="text" placeholder="Tìm kiếm công việc,vị trí bạn mong muốn">
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="fillter">
                           <span class="icon-header_fillter">
                               <i class="fa-solid fa-building"></i>
                           </span>
                           <select name="" id="">
                               <option value=""> Vị trí công việc</option>
                           </select>
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="fillter">
                           <span class="icon-header_fillter">
                               <i class="fa-solid fa-building"></i>
                           </span>
                           <select name="" id="">
                               <option value=""> Vị trí công việc</option>
                           </select>
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="fillter">
                           <span class="icon-header_fillter">  
                               <i class="fa-solid fa-location-dot"></i>
                           </span>
                           <select name="" id="">
                               <option value="">Địa Điểm</option>
                           </select>
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="fillter search_header">
                          <i class="fa-solid fa-magnifying-glass"></i> Tìm Kiếm
                       </div>
                   </div>
               </div>
  
       </div>
    @else
    @include('layout.publicview.header')
    @endif
    <div id="main">
        <div class="hot-company_hot-job">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="hot-company col-md-8">
                                <div class="hot-company-title">
                                    <h2 class="title"> <p>Công Ty </p> Nổi Bật</h2>
                                </div>
                                
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                      <div class="carousel-item active">
                                        <div class="company-content">
                                            <div class="company_item">
                                                <img src="../assets/image/86abff643f29067301dd713716101cdd-6385bcbe4a011.jpg" alt="" class="img_hot_company">
                                                <div class="company_decription">
                                                    <h4 class="company_name"><a href="#"> Công Ty Cổ Phần Kinh Doanh Và Dịch Vụ KICC</a></h4>
                                                    <p class="company_address">Địa chỉ: 1 Nguyễn Văn Linh, Phường 7, Quận Gò Vấp, TP. Hồ Chí Minh</p>
                                                    <p class="company_phone">Số điện thoại: 028 7300 8888</p>
                                                    <div class="detail">
                                                        <a href="#">Xem Thêm <i class="fa-solid fa-arrow-right"></i></a>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="carousel-item">
                                        <div class="company-content">
                                            <div class="company_item">
                                                <img src="../assets/image/86abff643f29067301dd713716101cdd-6385bcbe7f2ae.jpg" alt="" class="img_hot_company">
                                                <div class="company_decription">
                                                    <h4 class="company_name"><a href=""> Công Ty Cổ Phần Kinh Doanh Và Dịch Vụ KICC</a></h4>
                                                    <p class="company_address">Địa chỉ: 1 Nguyễn Văn Linh, Phường 7, Quận Gò Vấp, TP. Hồ Chí Minh</p>
                                                    <p class="company_phone">Số điện thoại: 028 7300 8888</p>
                                                    <div class="detail">
                                                        <a href="#">Xem Thêm <i class="fa-solid fa-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                      </div>
                                      <div class="carousel-item">
                                        <div class="company-content">
                                            <div class="company_item">
                                                <img src="../assets/image/86abff643f29067301dd713716101cdd-6385bcbe9d214.jpg" alt="" class="img_hot_company">
                                                <div class="company_decription">
                                                    <h4 class="company_name"><a href=""> Công Ty Cổ Phần Kinh Doanh Và Dịch Vụ KICC</a></h4>
                                                    <p class="company_address">Địa chỉ: 1 Nguyễn Văn Linh, Phường 7, Quận Gò Vấp, TP. Hồ Chí Minh</p>
                                                    <p class="company_phone">Số điện thoại: 028 7300 8888</p>
                                                    <div class="detail">
                                                        <a href="#">Xem Thêm <i class="fa-solid fa-arrow-right"></i></a>
                                                    </div>
                                                   
                                                </div>
                                            </div>
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
                            <div class="col-md-4">
                                <ul class="logo_company">
                                    <li class="list_img_logo"> <img src="../assets/image/86abff643f29067301dd713716101cdd-6385bcbe4a011.jpg" alt=""> </li>
                                    <li class="list_img_logo"> <img src="../assets/image/86abff643f29067301dd713716101cdd-6385bcbe7f2ae.jpg" alt=""></li>
                                    <li class="list_img_logo"> <img src="../assets/image/86abff643f29067301dd713716101cdd-6385bcbe9d214.jpg" alt=""></li>
                                    <li class="list_img_logo"> <img src="../assets/image/86abff643f29067301dd713716101cdd-6385bcbebefcf.jpg" alt=""></li>
                                </ul>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="hot-job">
                            <div class="hot-job-title">
                                <h2 class="title"><p>Công Việc</p>Nổi Bật</h2>
                            </div>
                            <div class="job-content">
                                <div class="job_item">
                                    <span class="name-company-job">Code Engine Studio</span>
                                    <div class="job_title"><a href="">Senior Full Stack Developer (JavaScript, React, NodeJS)</a></div>
                                    <div class="salary">1000$ - 2000$ <i class="fa-solid fa-bookmark"></i></div>
                                </div>
                                <div class="job_item">
                                    <span class="name-company-job">Code Engine Studio</span>
                                    <div class="job_title"><a href="">Senior Full Stack Developer (JavaScript, React, NodeJS)</a></div>
                                    <div class="salary">1000$ - 2000$ <i class="fa-solid fa-bookmark"></i></div>
                                </div>
                                <div class="job_item">
                                    <span class="name-company-job">Code Engine Studio</span>
                                    <div class="job_title"><a href="">Senior Full Stack Developer (JavaScript, React, NodeJS)</a></div>
                                    <div class="salary">1000$ - 2000$ <i class="fa-solid fa-bookmark"></i></div>
                                </div>
                            </div>
                            
                        </div>
                </div>
            </div>
            </div>
        </div>
        <div class="main_content">
            <div class="sum_job">
                <div class="total_job all">Tất cả(300)</div>
                <div class="total_job">Cái Răng(100)</div>
                <div class="total_job">Ninh Kiều(200)</div>
            </div>
            <div class="post">
                <div class="row post_company">
                    <div class="col-md-9">
                      <h5 class="header_name">Bài Tuyển Dụng Mới Nhất</h5>
                        <div class="post_item">
                            <div class="row">
                                <div class="col-md-8 img-title_job-description">
                                    <img src="../assets/image/pasted image 0.png" alt="">
                                    <div class="description-post">
                                        <h3 class="title-job"><a href="detail_post.html">Senior Full Stack Developer (JavaScript, React, NodeJS)</a></h3>
                                        <div class="company-name">Code Engine Studio</div>
                                        <div class="address">Cần Thơ</div>
                                        <div class="salary">1000$ - 2000$</div>
                                    </div>
        
                                </div>
                                <div class="col-md-4">
                                    <div class="post_time">1 ngày trước</div>
                                    <div class="icon_save_post"><i class="fa-solid fa-heart"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="post_item">
                            <div class="row">
                                <div class="col-md-8 img-title_job-description">
                                    <img src="../assets/image/pasted image 0.png" alt="">
                                    <div class="description-post">
                                        <h3 class="title-job"><a href="">Senior Full Stack Developer (JavaScript, React, NodeJS)</a></h3>
                                        <div class="company-name">Code Engine Studio</div>
                                        <div class="address">Cần Thơ</div>
                                        <div class="salary">1000$ - 2000$</div>
                                    </div>
        
                                </div>
                                <div class="col-md-4">
                                    <div class="post_time">1 ngày trước</div>
                                    <div class="icon_save_post"><i class="fa-solid fa-heart"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="post_item">
                            <div class="row">
                                <div class="col-md-8 img-title_job-description">
                                    <img src="../assets/image/images.jpg" alt="">
                                    <div class="description-post">
                                        <h3 class="title-job"><a href="">Senior Full Stack Developer (JavaScript, React, NodeJS)</a></h3>
                                        <div class="company-name">Code Engine Studio</div>
                                        <div class="address">Cần Thơ</div>
                                        <div class="salary">1000$ - 2000$</div>
                                    </div>
        
                                </div>
                                <div class="col-md-4">
                                    <div class="post_time">1 ngày trước</div>
                                    <div class="icon_save_post"><i class="fa-solid fa-heart"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="post_item">
                            <div class="row">
                                <div class="col-md-8 img-title_job-description">
                                    <img src="../assets/image/images.jpg" alt="">
                                    <div class="description-post">
                                        <h3 class="title-job"><a href="">Senior Full Stack Developer (JavaScript, React, NodeJS)</a></h3>
                                        <div class="company-name">Code Engine Studio</div>
                                        <div class="address">Cần Thơ</div>
                                        <div class="salary">1000$ - 2000$</div>
                                    </div>
        
                                </div>
                                <div class="col-md-4">
                                    <div class="post_time">1 ngày trước</div>
                                    <div class="icon_save_post"><i class="fa-solid fa-heart"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="post_item">
                            <div class="row">
                                <div class="col-md-8 img-title_job-description">
                                    <img src="../assets/image/images.jpg" alt="">
                                    <div class="description-post">
                                        <h3 class="title-job"><a href="">Senior Full Stack Developer (JavaScript, React, NodeJS)</a></h3>
                                        <div class="company-name">Code Engine Studio</div>
                                        <div class="address">Cần Thơ</div>
                                        <div class="salary">1000$ - 2000$</div>
                                    </div>
        
                                </div>
                                <div class="col-md-4">
                                    <div class="post_time">1 ngày trước</div>
                                    <div class="icon_save_post"><i class="fa-solid fa-heart"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="post_item">
                            <div class="row">
                                <div class="col-md-8 img-title_job-description">
                                    <img src="../assets/image/images.jpg" alt="">
                                    <div class="description-post">
                                        <h3 class="title-job"><a href="">Senior Full Stack Developer (JavaScript, React, NodeJS)</a></h3>
                                        <div class="company-name">Code Engine Studio</div>
                                        <div class="address">Cần Thơ</div>
                                        <div class="salary">1000$ - 2000$</div>
                                    </div>
        
                                </div>
                                <div class="col-md-4">
                                    <div class="post_time">1 ngày trước</div>
                                    <div class="icon_save_post"><i class="fa-solid fa-heart"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="post_item">
                            <div class="row">
                                <div class="col-md-8 img-title_job-description">
                                    <img src="../assets/image/images.jpg" alt="">
                                    <div class="description-post">
                                        <h3 class="title-job"><a href="">Senior Full Stack Developer (JavaScript, React, NodeJS)</a></h3>
                                        <div class="company-name">Code Engine Studio</div>
                                        <div class="address">Cần Thơ</div>
                                        <div class="salary">1000$ - 2000$</div>
                                    </div>
        
                                </div>
                                <div class="col-md-4">
                                    <div class="post_time">1 ngày trước</div>
                                    <div class="icon_save_post"><i class="fa-solid fa-heart"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 introduce_banner">
                        <div class="introduce_new_company">
                            <h4> Có thể bạn quan tâm</h4>
                            <div class="post_introduce_company">
                                <div class="img_introduce-company">
                                    <img src="../assets/image/images.jpg" alt="">
                                </div>
                                <div class="detail_introduce_company">
                                    <div class="name_company">
                                        <a href="#">Công ty TNHH Sailun Việt Nam</a>
                                    </div>
                                    <div class="describe">
                                        <a href="#">Quản Trị Viên Tập Sự (Sinh Viên)</a>
                                        <div class="salary-time_post">
                                                <span><i class="fa-solid fa-money-bill-1-wave"></i> Trên 9 triệu</span>
                                                <span><i class="fa-sharp fa-solid fa-clock"></i>31/12/2022</span>
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
                                <img src="../assets/image/pasted image 0.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog_it">
                <div class="header_name">
                    <h5>Blog IT</h5>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="blog_item">
                            <a href="#">

                                <img src="../assets/image/2.jpg" alt="">
                            </a>
                        
                        <div class="blog-describe">
                            <span class="describe_blog_text">
                                    Làm thế nào để tối ưu chi phí vận hành doanh nghiệp dưới
                            </span>
                        </div>
                        <div class="more-time-post">
                            <span class="more">
                                <a href="#">Chi tiết</a>
                            </span>
                            <span class="time-post_blog">
                                hôm nay
                            </span>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="blog_item">
                            <a href="#">

                                <img src="../assets/image/2.jpg" alt="">
                            </a>
                        
                        <div class="blog-describe">
                            <span class="describe_blog_text">
                                Trí tuệ nhân tạo (Artificial Intelligence) và cơn đau tim (Heart Attack)
                                Tiêu đề giật tít ư, ồ không, bài viết này đề cập tới Trí tuệ nhân tạo và áp dụng trí tuệ nhân tạo trong y tế, cụ thể ở...
                            </span>
                        </div>
                        <div class="more-time-post">
                            <span class="more">
                                <a href="#">Chi tiết</a>
                            </span>
                            <span class="time-post_blog">
                                hôm nay
                            </span>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="blog_item">
                            <a href="#">

                                <img src="../assets/image/2.jpg" alt="">
                            </a>
                        
                        <div class="blog-describe">
                            <span class="describe_blog_text">
                                Trí tuệ nhân tạo (Artificial Intelligence) và cơn đau tim (Heart Attack)
                                Tiêu đề giật tít ư, ồ không, bài viết này đề cập tới Trí tuệ nhân tạo và áp dụng trí tuệ nhân tạo trong y tế, cụ thể ở...
                            </span>
                        </div>
                        <div class="more-time-post">
                            <span class="more">
                                <a href="#">Chi tiết</a>
                            </span>
                            <span class="time-post_blog">
                                hôm nay
                            </span>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="blog_item">
                            <a href="#">

                                <img src="../assets/image/2.jpg" alt="">
                            </a>
                        
                        <div class="blog-describe">
                            <span class="describe_blog_text">
                                Trí tuệ nhân tạo (Artificial Intelligence) và cơn đau tim (Heart Attack)
                                Tiêu đề giật tít ư, ồ không, bài viết này đề cập tới Trí tuệ nhân tạo và áp dụng trí tuệ nhân tạo trong y tế, cụ thể ở...
                            </span>
                        </div>
                        <div class="more-time-post">
                            <span class="more">
                                <a href="#">Chi tiết</a>
                            </span>
                            <span class="time-post_blog">
                                hôm nay
                            </span>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top:15px">
                    <div class="col-md-3">
                        <div class="blog_item">
                            <a href="#">

                                <img src="../assets/image/2.jpg" alt="">
                            </a>
                        
                        <div class="blog-describe">
                            <span class="describe_blog_text">
                                    Làm thế nào để tối ưu chi phí vận hành doanh nghiệp dưới
                            </span>
                        </div>
                        <div class="more-time-post">
                            <span class="more">
                                <a href="#">Chi tiết</a>
                            </span>
                            <span class="time-post_blog">
                                hôm nay
                            </span>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="blog_item">
                            <a href="#">

                                <img src="../assets/image/2.jpg" alt="">
                            </a>
                        
                        <div class="blog-describe">
                            <span class="describe_blog_text">
                                Trí tuệ nhân tạo (Artificial Intelligence) và cơn đau tim (Heart Attack)
                                Tiêu đề giật tít ư, ồ không, bài viết này đề cập tới Trí tuệ nhân tạo và áp dụng trí tuệ nhân tạo trong y tế, cụ thể ở...
                            </span>
                        </div>
                        <div class="more-time-post">
                            <span class="more">
                                <a href="#">Chi tiết</a>
                            </span>
                            <span class="time-post_blog">
                                hôm nay
                            </span>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="blog_item">
                            <a href="#">

                                <img src="../assets/image/2.jpg" alt="">
                            </a>
                        
                        <div class="blog-describe">
                            <span class="describe_blog_text">
                                Trí tuệ nhân tạo (Artificial Intelligence) và cơn đau tim (Heart Attack)
                                Tiêu đề giật tít ư, ồ không, bài viết này đề cập tới Trí tuệ nhân tạo và áp dụng trí tuệ nhân tạo trong y tế, cụ thể ở...
                            </span>
                        </div>
                        <div class="more-time-post">
                            <span class="more">
                                <a href="#">Chi tiết</a>
                            </span>
                            <span class="time-post_blog">
                                hôm nay
                            </span>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="blog_item">
                            <a href="#">

                                <img src="../assets/image/2.jpg" alt="">
                            </a>
                        
                        <div class="blog-describe">
                            <span class="describe_blog_text">
                                Trí tuệ nhân tạo (Artificial Intelligence) và cơn đau tim (Heart Attack)
                                Tiêu đề giật tít ư, ồ không, bài viết này đề cập tới Trí tuệ nhân tạo và áp dụng trí tuệ nhân tạo trong y tế, cụ thể ở...
                            </span>
                        </div>
                        <div class="more-time-post">
                            <span class="more">
                                <a href="#">Chi tiết</a>
                            </span>
                            <span class="time-post_blog">
                                hôm nay
                            </span>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layout.publicview.footer')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>