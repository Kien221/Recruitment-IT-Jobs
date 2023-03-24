
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
                                <a href="#" class="icon_link"><i class="fa-solid fa-comment"></i></a>
                            </li>
                            <li class="menu">
                                <div class="icon_link"><i class="fa-solid fa-bell" id="message_account"></i>
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
                                let id_applicant = '{{session('id_applicant')}}';
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
                                var private = pusher.subscribe('Recruitment-channel.'+ id_applicant);
                                private.bind('hr-accept-applicantcv', function(data) {             
                                    $('#message').css('display','block');
                                    $('#message').css('background-color','#00b894');
                                    $('#message').css('color','#fff');
                                    $('#message').css('padding','10px');
                                    $('#message').css('border-radius','5px');
                                    $('#message').css('margin-bottom','10px');
                                    $('#message').css('margin-top','10px');
                                    $('#message').css('width','100%');
                                    $('#message').css('text-align','center');
                                    $('#message').css('position','fixed');
                                    $('#message').css('z-index','9999');
                                    $('#message').css('bottom','0');
                                    $('#message').css('right','0');
                                    $('#message').css('margin','auto');
                                    $('#message').css('font-size','20px');
                                    $('#message').css('font-weight','bold');
                                    $('#message').css('box-shadow','0 0 10px rgba(0,0,0,0.5)');
                                    $('#message').css('transition','all 0.5s ease');
                                    $('#message').css('opacity','0');
                                    $('#message').css('transform','translateY(-100px)');
                                    $('#message').css('transition-delay','0.5s');
                                    $('#message').css('transition','all 0.5s ease');
                                    $('#message').css('opacity','1');
                                    $('#message').css('transform','translateY(0px)');
                                    $('#message').css('transition-delay','0.5s');
                                    $('#message').html(data.message);
                                    setTimeout(function(){
                                        $('#message').css('display','none');
                                    }, 10000);
                                
                                        $.ajax({
                                            url:'{{route('count.messages')}}',
                                            type:'GET',
                                            dataType:'json',
                                            data:{
                                                id_applicant:{{session('id_applicant')}}
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
                            </script>
                                                        
                            <li class="menu">
                               
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
                             
                            </li>
                            <li class="menu">
                                <a href="{{route('logout')}}" class="icon_link">logout</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
                      
        </div>
      </div>
</div>
<script>
    $(document).ready(function(){
        $.ajax({
            url:'{{route('count.messages')}}',
            type:'GET',
            dataType:'json',
            data:{
                id_applicant:{{session('id_applicant')}}
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

        $('#message_account').click(function(){
            $.ajax({
                url:'{{route('list.messages')}}',
                type:'GET',
                dataType:'json',
                data:{
                    id_applicant:{{session('id_applicant')}}
                },
                success:function(data){
                    $('#list-messages').css('display','block');
                    $('#list-messages').html(data);
                    $list_messages_not_seen = document.getElementsByClassName('message');
                    console.log($list_messages_not_seen);
                    for(let i = 0; i<$list_messages_not_seen.length; i++){
                        $list_messages_not_seen[i].addEventListener('click',function(){
                            $id_message = $(this).val();
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
</script>

