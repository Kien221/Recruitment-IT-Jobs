<div id="header">
    <div class="top-header">
        <div class="top-header-left">
            <a href="{{route('home')}}">
                <img src="{{asset('image/Logo_TopCV_no_slogan.png')}}" alt="" class="logo">
            </a>
            <h1 class="text-header"><span>Việc Làm</span> IT Hàng Đầu</h1>
        </div>
        <div class="top-header-right">
            <ul class="list-info">
                <li class="number_phone">
                    <a href="#"><i class="fa-solid fa-phone"></i> 0395004764</a>
                    <p class="space">|</p>
                </li>
                <li class="post_text">
                    <a href="#">
                        <i class="fa-solid fa-feather"></i> Đăng tin
                    </a>
                    <p class="space">|</p>

                </li>
                <li class="contact">
                    <a href="#">

                        <i class="fa-solid fa-address-book"></i> Liên hệ
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="middle-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <ul class="list-menu">
                            <li class="menu">
                                <a href="{{route('home')}}">
                                    <i class="fa-solid fa-bars"></i>
                                </a>
                            </li>
                            <li class="menu">
                                <a href="{{route('home')}}">Việc làm IT</a>
                            </li>
                            <li class="menu">
                                <a href="{{route('applicantView')}}">Tạo CV</a>
                            </li>
                            <li class="menu">
                                <a href="#">Công Ty IT</a>
                            </li>
                            <li class="menu">
                                <a href="#">Blog IT</a>
                            </li>
                            <li class="menu">
                                <a href="#">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right_applicant_view">
                        <ul class="list-menu">
                            <li class="menu">
                                <a href="{{route('chatting_View_Applicant')}}" class="icon_link"><i
                                        class="fa-solid fa-comment"></i>
                                </a>
                                <span
                                    style="padding:5px;border-radius:30%;background-color:red;color:white;position:absolute;margin-top:-42px;margin-left: 13px;display:none;"
                                    id="count_chatting_not_seen"></span>
                            </li>
                            <li class="menu">
                                <div class="icon_link"><i class="fa-solid fa-bell" id="message_account"></i>
                                    <span
                                        style="padding:5px;border-radius:30%;background-color:red;color:white;position:absolute;margin-top:-33px;margin-left: 14px;display:none;"
                                        id="count_message">
                                    </span>
                                    <div class="list-messages" id="list-messages">
                                    </div>
                                </div>
                            </li>

                            <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script
                                src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
                            <script>
                                Pusher.logToConsole = true;
                                let id_applicant = '{{session('id_applicant')}}';
                                var pusher = new Pusher('f159bf8e622a9a565b4f', {
                                    cluster: 'ap1',
                                    encrypted: true,
                                    authEndpoint: 'http://localhost:8000/broadcasting/auth',
                                    auth: {
                                        headers: {
                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    },

                                })
                                var private_notify = pusher.subscribe('Recruitment-channel.' + id_applicant);
                                private_notify.bind('hr-accept-applicantcv', function (data) {
                                    $('#email_notify').css('display','block');
                                    $('.me-auto').html('Một Thông Báo Mới');
                                    $('#title_message').html(data.message);
                                    setTimeout(function () {
                                        $('#email_notify').css('display', 'none');
                                    }, 10000);

                                    $.ajax({
                                        url: '{{route('count.messages')}}',
                                        type: 'GET',
                                        dataType: 'json',
                                        data: {
                                            id_applicant: {{ session('id_applicant') }},
                                    from_to : 'applicant'
                                            },
                                    success: function (data) {
                                        if (data.count_message != 0) {
                                            $('#count_message').css('display', 'block');
                                            $('#count_message').html(data.count_message);
                                        }
                                    },
                                    error: function (error) {
                                        console.log(error);
                                    }
                                        })

                                });

                                var pusher2 = new Pusher('f159bf8e622a9a565b4f', {
                                    cluster: 'ap1',
                                    encrypted: true,
                                    authEndpoint: 'http://localhost:8000/broadcasting/auth',
                                    auth: {
                                        headers: {
                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    },

                                })
                                var applicant_received_chatting_private = pusher2.subscribe('UserReceivedChattingMessage.' + id_applicant);
                                applicant_received_chatting_private.bind('UserReceivedChattingMessage', function (data) {
                                    $.ajax({
                                        url: '{{route('count.chatting.messages.not.seen')}}',
                                        type: 'GET',
                                        dataType: 'json',
                                        data: {
                                            applicant_id: id_applicant,
                                            from_to: 0
                                        },
                                        success: function (data) {
                                            console.log(data);
                                            if (data.count_chatting_message_not_seen == 0) {
                                                $('#count_chatting_not_seen').css('display', 'none');
                                            }
                                            else{
                                                $('#count_chatting_not_seen').css('display', 'block');
                                                $('#count_chatting_not_seen').html(data.count_chatting_message_not_seen);
                                            }

                                        },
                                        error: function (error) {
                                            console.log(error);
                                        }
                                    })
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

                            <li class="menu" id="submenu">
                                <div class="profile">
                                    @if(session('avatar') != null)
                                    <img src="{{asset('storage/'.session('avatar'))}}" alt="">
                                    @endif
                                    @if(session('avatar_newuser') !== null)
                                    <img src="{{session('avatar_newuser')}}" alt="">
                                    @endif
                                    <a href="{{route('home')}}">
                                        <span class="name_user">{{session('applicant_name')}}</span>
                                    </a>
                                    <i class="fa-solid fa-chevron-down"></i>    
                                </div>
                                <ul class="submenu">
                                    <li class="list_nav_hr_view_item">
                                        <a href="{{route('applicantView')}}"><i class="fa-regular fa-file"></i>Tạo CV</a>
                                    </li>
                                    <li class="list_nav_hr_view_item">
                                        <a href="{{route('applicant.index.view')}}" class="icon_link"><i class="fa-regular fa-user"></i>CV của tôi</a>
                                    </li>
                                    <li class="list_nav_hr_view_item">
                                        <a href="{{route('jobs.apply.view')}}" class="icon_link"><i class="fa-regular fa-pen-to-square"></i>Việc đã ứng tuyển</a>
                                    </li>
                                    <li class="list_nav_hr_view_item">
                                        <a href="{{route('save.post.view')}}" class="icon_link"><i class="fa-solid fa-gear"></i>Việc đã lưu</a>
                                    </li>
                                    <li class="list_nav_hr_view_item">
                                        <a href="{{route('logout')}}" class="icon_link"><i class="fa-regular fa-sign-out"></i>Đăng xuất</a>
                                    </li>
                                </ul>
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
                                            #submenu .submenu a{
                                                text-decoration: none;
                                                color: black;
                                            }

                                            #submenu:hover .submenu {
                                                display: block;
                                                

                                            }
                                            .list_nav_hr_view_item{
                                                padding: 20px;
                                                text-decoration: none;
                                                display: block;
                                                color: black;
                                                font-size: 14px;
                                                border-bottom: 1px solid #f1f1f1;
                                            }
                                            .list_nav_hr_view_item i{
                                                margin-right: 10px;
                                            }

                                    </style>
                            </li>
                        </ul>
                        

                    </div>
                </div>
            </div>
            <div id="message">

            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '{{route('count.chatting.messages.not.seen')}}',
            type: 'GET',
            dataType: 'json',
            data: {
                applicant_id: id_applicant,
                from_to: 0
            },
            success: function (data) {
                console.log(data);
                if (data.count_chatting_message_not_seen != 0) {
                    $('#count_chatting_not_seen').css('display', 'block');
                    $('#count_chatting_not_seen').html(data.count_chatting_message_not_seen);
                }

            },
            error: function (error) {
                console.log(error);
            }
        })
        $.ajax({
            url: '{{route('count.messages')}}',
            type: 'GET',
            dataType: 'json',
            data: {
                id_applicant: {{ session('id_applicant') }},
        from_to : 'applicant'
            },
        success: function (data) {
            if (data.count_message != 0) {
                $('#count_message').css('display', 'block');
                $('#count_message').html(data.count_message);
            }

        },
        error: function (error) {
            console.log(error);
        }

        })

    $('#message_account').click(function () {
        $.ajax({
            url: '{{route('list.messages')}}',
            type: 'GET',
            dataType: 'json',
            data: {
                id_applicant: {{ session('id_applicant') }}
                },
        success: function (data) {
            $('#list-messages').css('display', 'block');
            $('#list-messages').html(data);
            $list_messages_not_seen = document.getElementsByClassName('message');
            console.log($list_messages_not_seen);
            for (let i = 0; i < $list_messages_not_seen.length; i++) {
                $list_messages_not_seen[i].addEventListener('click', function () {
                    $id_message = $(this).val();
                    console.log($id_message)
                    $.ajax({
                        url: '{{route('update.status.message')}}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            id_message: $id_message
                        },
                        success: function (data) {
                            console.log(data)
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    })

                })
            }

        },
        error: function (error) {
            console.log(error);
        }
            })
        })
    $(document).scroll(function () {
        $('#list-messages').css('display', 'none');
    })
    $(document).on('click', function (e) {
        if ($(e.target).closest("#list-messages").length === 0) {
            $("#list-messages").hide();
        }
    });
    });
</script>