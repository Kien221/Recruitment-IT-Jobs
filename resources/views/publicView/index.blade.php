<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/public.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/applicant.css')}}">
    <script src="{{asset('js/js.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Tuyển dụng IT</title>
</head>
<body>
    @if(session('success_login_applicant'))
        @include('layout.applicantview.header')
    @elseif(session('success_login_hr'))
        @include('layout.hrview.public_header')
    @else
        @include('layout.publicview.header')
    @endif
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
    </div>
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
                                      @foreach($hot_companies as $hot_company)
                                       <input type="hidden" value="{{$hot_company->id}}">
                                        @if($loop->first)
                                            <div class="carousel-item active">
                                        @else
                                        <div class="carousel-item">
                                        @endif
                                            <div class="company-content">
                                                <div class="company_item">
                                                    <img src="{{asset('storage/'.$hot_company->logo)}}" alt="" class="img_hot_company">
                                                    <div class="company_decription">
                                                        <h4 class="company_name"><a href="">{{$hot_company->name}}</a></h4>
                                                        <p class="company_address">{{$hot_company->address}}</p>
                                                        <p class="company_phone">Số điện thoại: {{$hot_company->phone}}</p>
                                                        <div class="detail">
                                                            <a href="#">Xem Thêm <i class="fa-solid fa-arrow-right"></i></a>
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>      
                                      @endforeach    
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
                                    <input type="hidden" value="{{$hot_company->id}}">
                                    @foreach($hot_companies as $hot_company)
                                    <li class="list_img_logo"> <img src="{{asset('storage/'.$hot_company->logo)}}" alt=""> </li>
                                    @endforeach
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
                                <div class="list_hot_job">
                                    @foreach($hot_jobs as $hot_job)
                                    <div class="job_item">
                                        <span class="name-company-job">{{$hot_job->company->name}}</span>
                                        <div class="job_title"><a href="{{route('post.detail',[$hot_job->id,$hot_job->slug])}}">{{$hot_job->title}}</a></div>
                                        <div class="salary">{{$hot_job->min_salary}}{{$hot_job->unit_money}}-{{$hot_job->max_salary}}{{$hot_job->unit_money}} <i class="fa-solid fa-bookmark"></i></div>
                                    </div>
                                    @endforeach
                                    {!!$hot_jobs->links()!!}
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
                <!-- <div class="total_job">Cái Răng(100)</div>
                <div class="total_job">Ninh Kiều(200)</div> -->
            </div>
            <div class="post">
                <div class="row post_company">
                    <div class="col-md-9">
                      <h5 class="header_name">Bài Tuyển Dụng Mới Nhất</h5>
                      <div class="list_posts">
                          @foreach($posts as $post)
                            <div class="post_item">
                                <div class="row">
                                    <div class="col-md-8 img-title_job-description">    
                                        <img src="{{asset('storage/'.$post->company_logo)}}" alt="">
                                        <div class="description-post">
                                            <h3 class="title-job"><a href="{{route('post.detail',[$post->id,$post->slug])}}">{{$post->title}}</a></h3>
                                            <div class="company-name">{{$post->company_name}}</div>
                                            <span class="btn-introduce-post" style="color:black;">{{$post->min_salary}} {{$post->unit_money}} - {{$post->max_salary}} {{$post->unit_money}}</span>
                                            <span class="btn-introduce-post" style="color:black;">Hết hạn - {{$post->expired_post}}</span>
                                            <span class="btn-introduce-post" style="color:black;">{{$post->city}}</span>
                                        </div>
                                        <!-- @foreach (json_decode($post->languages) as $languages)
                                                {{ $languages }}
                                        @endforeach -->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="post_time">{{  \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</div>
                                        <div class="icon_save_post"><i class="fa-solid fa-heart"></i></div>
                                    </div>
                                </div>
                            </div>        
                          @endforeach    
                          <p>{!! $posts->links() !!}</p>  

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
                                        <a href="#">{{$review_company->name}}</a>
                                    </div>
                                    <div class="describe">
                                        <a href="#">{{$review_company->title}}</a>
                                        <div class="salary-time_post">
                                                <span><i class="fa-solid fa-money-bill-1-wave"></i>{{$review_company->min_salary}}-{{$review_company->max_salary}}{{$review_company->unit_money}}</span>
                                                <span><i class="fa-sharp fa-solid fa-clock"></i>{{$review_company->expired_date()}} hết hạn</span>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
                        url:"api/ajax-paginate-posts?page="+page,
                        success:function(res){
                            $('.list_posts').html(res);
                        },
                        error:function(err){
                            console.log(err);
                        }
                    })
            };
            $(document).on('click','.list_hot_job>nav>ul a', function(e){
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            record_hot_jobs(page)
            })
            function record_hot_jobs(page){
                $.ajax({
                    url:"api/ajax-paginate-hot-jobs?page="+page,
                    success:function(res){
                        $('.list_hot_job').html(res);
                    },
                    error:function(err){
                        console.log(err);
                    }
                })
            }
        })
    </script>
</body>

</html>