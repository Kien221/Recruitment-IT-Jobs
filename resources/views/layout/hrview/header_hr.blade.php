<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/public.css')}}">
    <link rel="stylesheet" href="{{asset('css/hr.css')}}">
    <link rel="stylesheet" href="{{asset('css/applicant.css')}}">
    <script src="{{asset('js/js.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <title>{{ config('app.name')}} @yield('title')</title>
   
</head>
<body>
    <div id="header">
        <div class="middle-header" id="header_hr_view">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="left">
                            <a href="{{route('home')}}">
                                <img src="https://blog.topcv.vn/wp-content/uploads/2019/02/logo-top-cv-_FFFFFF.png" alt="" class="logo_hr_view">
                            </a>
                        </div>
                    </div>  
                    <div class="col-md-9">
                        <div class="right_applicant_view">
                            <ul class="list-menu">
                                <li class="menu">
                                    <a href="{{route('hr.create_post.view')}}" class="icon_link"><i class="fa-regular fa-pen-to-square"></i>Đăng bài</a>
                                </li>
                                <li class="menu">
                                    <span class="icon_link" style="color:white;cursor:pointer" id="search_cv"><i class="fa-regular fa-pen-to-square"></i>Tìm CV</span>
                                </li>
                                <li class="menu">
                                    <a href="#" class="icon_link"><i class="fa-regular fa-circle-question"></i>Trợ giúp</a>
                                </li>
                                <li class="menu">
                                    <a href="{{route('chatting_View_Hr')}}" class="icon_link"><i class="fa-solid fa-comment"></i>
                                    <span style="padding:5px;border-radius:30%;background-color:red;color:white;position:absolute;margin-top:-35px;margin-left: -18px;display:none;" id="count_chatting_not_seen"></span>
     
                                    Connect</a>
                                </li>
                                <li class="menu">
                                        <div class="icon_link"><i class="fa-solid fa-bell" id="message_hr_account"></i>
                                        <span style="padding:5px;border-radius:30%;background-color:red;color:white;position:absolute;margin-top:-33px;margin-left: 14px;display:none;" id="count_message">
                                        </span>
                                        <div class="list-messages" id="list-messages">
                                        </div>
                                    </div>
                                </li>
                                
                            <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
                            <script>
                                Pusher.logToConsole = true;
                                let hr_id = '{{session('id_hr')}}';
                                var pusher = new Pusher('f159bf8e622a9a565b4f', {
                                    cluster: 'ap1', 
                                    encrypted:true,
                                    authEndpoint: 'http://localhost:8000/broadcasting/auth',
                                    auth: {
                                        headers: {
                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    },

                                })
                                var private = pusher.subscribe('ApplicantSendCv-channel.'+ hr_id);
                                private.bind('applicant-send-cv', function(data) {            
                                    $('#email_notify').css('display','block');
                                    $('.me-auto').html('Một Thông Báo Mới');
                                    $('#title_message').html(data.message);
                                    setTimeout(function(){
                                        $('#email_notify').css('display','none');
                                    }, 10000);
                                
                                        $.ajax({
                                            url:'{{route('count.messages')}}',
                                            type:'GET',
                                            dataType:'json',
                                            data:{
                                                hr_id:{{session('id_hr')}},
                                                from_to:'hr'
                                            },
                                            success:function(data){
                                                if(data.count_message != 0){
                                                    $('#count_message').css('display','block');
                                                    $('#count_message').html(data.count_message);
                                                }
                                            },
                                            error:function(error){
                                                console.log(error);
                                            }
                                        })

                                });
                                

                                var pusher3 = new Pusher('f159bf8e622a9a565b4f', {
                                    cluster: 'ap1', 
                                    encrypted:true,
                                    authEndpoint: 'http://localhost:8000/broadcasting/auth',
                                    auth: {
                                        headers: {
                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    },

                                })
                                var hr_received_chatting_private = pusher3.subscribe('UserReceivedChattingMessage.'+ hr_id);
                                hr_received_chatting_private.bind('UserReceivedChattingMessage', function(data) {   
                                    $('#email_notify').css('display','block');
                                    $('.me-auto').html('Tin Nhắn');
                                    $('#title_message').html(data.message); 
                                    setTimeout(function(){
                                        $('#email_notify').css('display','none');
                                    }, 5000);
                                    $.ajax({
                                            url:'{{route('count.chatting.messages.not.seen')}}',
                                            type:'GET',
                                            dataType:'json',
                                            data:{
                                                hr_id:{{session('id_hr')}},
                                                from_to: 1
                                            },
                                            success:function(data){
                                                console.log(data);
                                                if(data.count_chatting_message_not_seen != 0){
                                                    $('#count_chatting_not_seen').css('display','block');
                                                    $('#count_chatting_not_seen').html(data.count_chatting_message_not_seen);
                                                }
                                            },
                                            error:function(error){
                                                console.log(error);
                                            }
                                        })
                                });

                                var pusher4 = new Pusher('f159bf8e622a9a565b4f', {
                                    cluster: 'ap1', 
                                    encrypted:true,
                                    authEndpoint: 'http://localhost:8000/broadcasting/auth',
                                    auth: {
                                        headers: {
                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    },

                                })
                                var adminsendemailnotifyenvet = pusher4.subscribe('AdminSendEmailNotifyEvent-channel');
                                adminsendemailnotifyenvet.bind('AdminSendEmailNotifyEvent', function(data) {  
                                    console.log(data);          
                                    $('#email_notify').css('display','block');
                                    $('#title_message').html(data.message);
                                    setTimeout(function(){
                                        $('#email_notify').css('display','none');
                                    }, 10000);
                                });  
                                </script>
                                
                                <div class="toast" style="position: fixed;
                                    bottom: 0;
                                    right: 0;
                                    margin: 20px;
                                    z-index: 9999;" role="alert" id="email_notify" aria-live="assertive" aria-atomic="true">
                                    <style>
                                        .toast:not(.showing):not(.show) {
                                        opacity: 1 !important;
                                        display: none;
                                        }
                                    </style>
                                    <div class="toast-header">
                                        <img src="https://static.topcv.vn/v4/image/logo/topcv-logo-tet-holiday.png" class="rounded me-2" alt="..." height="36px">
                                        <strong class="me-auto" style="font-size:18px">Admin</strong>
                                        <small class="text-muted"></small>
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body">
                                        <span id="title_message" style="font-size: 16px;
                                            color: maroon;">vài giây trước</span>
                                        <div class="mt-2 pt-2 border-top">
                                        <button type="button" class="btn btn-success btn-sm">
                                            <a href="{{route('email.from.admin')}}" style="color:white;text-decoration:none">
                                                 Xem ngay
                                            </a>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="toast">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <li class="menu">
                                    @if(session('id_hr'))
                                    <div class="profile">
                                        <img src="{{asset('storage/images/'.session('avatar'))}}" alt="">
                                        <span class="name_user">{{session('hr_name')}}</span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                    <ul class="submenu">
                                        <li class="list_nav_hr_view_item">
                                            <a href="{{route('hr.index')}}"><i class="fa-regular fa-file"></i> Bảng tin</a>
                                        </li>
                                        <li class="list_nav_hr_view_item">
                                            <a href="{{route('show.posted.view')}}" class="icon_link"><i class="fa-regular fa-pen-to-square"></i>Tin Tuyển Dụng</a>
                                        </li>
                                        <li class="list_nav_hr_view_item">
                                            <a href="{{route('list.applicants.accepted')}}" class="icon_link"><i class="fa-regular fa-user"></i>Quản lý CV</a>
                                            
                                        </li>
                                        <li class="list_nav_hr_view_item">
                                            <a href="{{route('create.company.view')}}" class="icon_link"><i class="fa-solid fa-gear"></i>Cài đặt tài khoản</a>
                                        </li>
                                        <li class="list_nav_hr_view_item">
                                            <a href="{{route('email.from.admin')}}" class="icon_link"><i class="fa-regular fa-bell"></i>Hệ thống thông báo</a>
                                        </li>
                                        <li class="list_nav_hr_view_item">
                                            <a href="#" class="icon_link"><i class="fa-regular fa-envelope"></i>Hộp thư hỗ trợ</a>
                                        </li>

                                    </ul>
                                    @endif
                                    <style>
                                            .submenu {
                                                display: none;
                                                position: fixed;
                                                background-color: #f9f9f9;
                                                min-width: 190px;
                                                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                                                z-index: 1000;
                                                padding: 0px;
                                                list-style: none;
                                                border-radius: 5px;
                                            }

                                            .menu:hover .submenu {
                                                display: block;
                                            }

                                    </style>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="message">

                </div>
                <div id="search_results">
                <div class="end-header">       
               <div class="row">
                   <div class="col-md-3">
                       <div class="search-input">
                           <input type="text" placeholder="Vị trí muốn tuyển dụng" id="search_by_position_want_to_open">
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="fillter">
                           <div class="search-input">
                           <input type="text" placeholder="Số năm kinh nghiệm" id="search_by_exp_year_work">
                       </div>
                       </div>
                   </div>
                  
                   <div class="col-md-2">
                       <div class="fillter">
                           <div class="search-input">
                           <input type="text" placeholder="Ngôn ngữ" id="search_by_language">
                       </div>
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="fillter">
                           <select name="" id="choice_city">
                               <option value="">Địa Điểm</option>
                           </select>
                       </div>
                   </div>
                   <div class="col-md-2">
                       <div class="fillter search_header" id="search_header">
                          <i class="fa-solid fa-magnifying-glass"></i> Tìm Kiếm
                       </div>
                       <span id="close" style="color: red;float: right;font-size: 30px;margin-top: -40px;margin-right: -50px;cursor:pointer">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                        </span>
                   </div>
               </div>
  
       </div>
                    <div id="content-cv" style="display:none">

                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
    $(document).ready(function(){
        $.ajax({
            url:'{{route('count.messages')}}',
            type:'GET',
            dataType:'json',
            data:{
                hr_id:{{session('id_hr')}},
                from_to:'hr'
            },
            success:function(data){
                if(data.count_message != 0){
                    $('#count_message').css('display','block');
                    $('#count_message').html(data.count_message);
                }
              
            },
            error:function(error){
                console.log(error);
            }

        })
        $.ajax({
                                            url:'{{route('count.chatting.messages.not.seen')}}',
                                            type:'GET',
                                            dataType:'json',
                                            data:{
                                                hr_id:{{session('id_hr')}},
                                                from_to:1
                                            },
                                            success:function(data){
                                                console.log(data);
                                                if(data.count_chatting_message_not_seen == 0){
                                                    $('#count_chatting_not_seen').css('display','none');
                                                }
                                                else{
                                                    $('#count_chatting_not_seen').css('display','block');
                                                    $('#count_chatting_not_seen').html(data.count_chatting_message_not_seen);
                                                }
                                            },
                                            error:function(error){
                                                console.log(error);
                                            }
                                        })

        $('#message_hr_account').click(function(){
            console.log('click');   
            $.ajax({
                url:'{{route('list.messages.hr')}}',
                type:'GET',
                dataType:'json',
                data:{
                    hr_id:{{session('id_hr')}},
                    from_to:'hr'
                },
                success:function(data){
                    console.log(data);
                    $('#list-messages').css('display','block');
                    $('#list-messages').html(data);
                    $list_messages_not_seen = document.getElementsByClassName('message');
                    console.log($list_messages_not_seen);
                    for(let i = 0; i<$list_messages_not_seen.length; i++){
                        $list_messages_not_seen[i].addEventListener('click',function(){
                            $id_message = $(this).val();
                            console.log($id_message)
                            $.ajax({
                                url:'{{route('update.status.message')}}',
                                type:'GET',
                                dataType:'json',
                                data:{
                                    id_message:$id_message
                                },
                                success:function(data){
                                    console.log(data)
                                },
                                error:function(error){
                                    console.log(error);
                                }
                            })
                            
                        })
                    }

                },
                error:function(error){
                    console.log(error);
                }
            })
        })
        $(document).scroll(function(){
                $('#list-messages').css('display','none');
        }) 
        $(document).on('click', function (e) {
        if ($(e.target).closest("#list-messages").length === 0) {
            $("#list-messages").hide();
        }
});
    });

    $("#search_cv").on('click',function(e){
        $('#search_results').css('display','block');
    })
    $('#close').click(function(){
            $('#search_results').css('display','none');
    })
    
</script>
<script>
        $(document).ready(async function(){
            const response = await fetch('{{asset('locations/index.json')}}');
            const cities = await response.json();
            $.each(cities, function (index, each){      
                   $('#choice_city').append(`
                   <option value='${index}' data-path='${each.file_path}'>${index}</option>
                   `);
   
            })

        })

        $('#search_header').on('click',function(){
                $('#search_results').css('display','block');
                let search_by_position_want_to_open = $('#search_by_position_want_to_open').val();
                let search_by_exp_year_work = $('#search_by_exp_year_work').val();
                let search_by_language = $('#search_by_language').val();
                let choice_city = $('#choice_city').val();

                $.ajax({
                    url: '{{route('search.cv.applicant')}}',
                    type: 'GET',
                    data: {
                        search_by_position_want_to_open: search_by_position_want_to_open,
                        search_by_exp_year_work: search_by_exp_year_work,
                        search_by_language: search_by_language,
                        search_by_city: choice_city,
                    },
                    dataType:'json',
                    success: function (data) {
                        $('#content-cv').css('display','block');  
                        $('#content-cv').html(data.data);  
                        $('.close').click(function(){
                        $('#search_results').css('display','none');
                        })
                    },
                    error:function(error){
                        console.log(error);
                    }
                })
            })


    </script>

</body>
</html>
