<head?>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
	<script
		src='//production-assets.codepen.io/assets/editor/live/console_runner-079c09a0e3b9ff743e39ee2d5637b9216b3545af0de366d4b9aad9dc87e26bfd.js'></script>
	<script
		src='//production-assets.codepen.io/assets/editor/live/events_runner-73716630c22bbc8cff4bd0f07b135f00a0bdc5d14629260c3ec49e5606f98fdd.js'></script>
	<script
		src='//production-assets.codepen.io/assets/editor/live/css_live_reload_init-2c0dc5167d60a5af3ee189d570b1835129687ea2a61bee3513dee3a50c115a77.js'></script>
	<meta charset='UTF-8'>
	<meta name="robots" content="noindex">
	<link rel="shortcut icon" type="image/x-icon"
		href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
	<link rel="mask-icon" type=""
		href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg"
		color="#111" />
	<link rel="canonical" href="https://codepen.io/emilcarlsson/pen/ZOQZaV?limit=all&page=74&q=contact+" />
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet'
		type='text/css'>

	<script src="https://use.typekit.net/hoy3lrg.js"></script>
	<script>try { Typekit.load({ async: true }); } catch (e) { }</script>
	<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
	<link rel='stylesheet prefetch'
		href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
	<link rel="stylesheet" href="{{asset('css/chatting.css')}}">
	</head>
	<div id="frame">
		<div id="sidepanel">
			<div id="profile">
				<div class="wrap">
					@if(session('avatar') != null)
					<img id="profile-img" src="{{asset('storage/'.session('avatar'))}}" alt="" class="online"
						style="width:45px;height:45px;">
					@endif
					@if(session('avatar_newuser') !== null)
					<img id="profile-img" src="{{session('avatar_newuser')}}" alt="" class="online"
						style="width:45px;height:45px;">
					@endif
					<p>{{session('applicant_name')}}</p>
					<i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
				</div>
			</div>
			<div id="search">
				<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
				<input type="text" placeholder="Search contacts..." />
			</div>
			@if($rooms_chat_of_applicant->count() == 0)
			<div class="without_contact" style="position: absolute;top: 45%;left: 52%;">
				<img src="https://candidate.topcvconnect.com/img/no-conversation.8966b27a.png" alt=""
					style="height:200px">
				<p style="margin-left:-20px;margin-top:10px;font-size: 18px;">Bạn chưa liên hệ với bất kì ứng cử viên
					nào!!!</p>
			</div>
			@else
			<div id="contacts">
				<ul>
					@foreach($rooms_chat_of_applicant as $room_chat)
					@if($room_chat->from == 1)
					@if($room_chat->status == 0)
					<li class="contact" style="background-color:lightslategray;margin-top:5px" value="{{$room_chat->room_id}}">
					@else
					<li class="contact" style="margin-top:5px" value="{{$room_chat->room_id}}">
					@endif
					@else
					<li class="contact" style="margin-top:5px" value="{{$room_chat->room_id}}">
					@endif
						<div class="wrap">
							<span class="contact-status online"></span>
							<img src="{{asset('storage/'.$room_chat->company_logo)}}" alt="" style="width:45px;height:45px;"/>
							@if($room_chat->from == 1 && $room_chat->status == 0)
							<div class="meta" style="color:black">
							@else
							<div class="meta">
							@endif
								<p class="name">{{$room_chat->company_name}}</p>
								@if($room_chat->from == 0)
								<p class="preview">Bạn : {{$room_chat->last_message}}</p>
								@else
								<p class="preview">{{$room_chat->last_message}}</p>
								@endif
							</div>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
			@endif
			<div id="bottom-bar">
				<button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add
						contact</span></button>
				<button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
			</div>
		</div>
		<div class="content">

		</div>

		<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>   
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
                            <script>
								Pusher.logToConsole = true;
								var applicant_id = '{{session('id_applicant')}}';
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
                                var applicant_received_chatting_private = pusher3.subscribe('UserReceivedChattingMessage.'+ applicant_id);
                                applicant_received_chatting_private.bind('UserReceivedChattingMessage', function(data) {     
                                    $.ajax({
                                            url:'{{route('list.roomchat')}}',
                                            type:'GET',
                                            dataType:'json',
                                            data:{
                                                applicant_id:applicant_id,
                                                from_to:0 
                                            },
                                            success:function(data){
												$('#contacts').html('');
												$('#contacts').html(data);
												const list_contact = document.querySelectorAll('.contact');
												console.log(list_contact.length);
												for (var i = 0; i < list_contact.length; i++) {
													list_contact[i].addEventListener('click', function () {
														var room_id = $(this).val();
														console.log(room_id);
														$.ajax({
															url: "{{route('applicant.show_message.by.room_id')}}",
															type: "GET",
															data: {
																room_id: room_id,
															},
															success: function (data) {
																console.log(data.data_html);
																$('.content').html(data.data_html);
															}
														});

													});
												}
                                            },
                                            error:function(error){
                                                console.log(error);
                                            }
                                        })
                                });
                            </script>
	</div>
	<script
		src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'></script>
	<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
	<script>
		const list_contact = document.querySelectorAll('.contact');
		console.log(list_contact.length);
		for (var i = 0; i < list_contact.length; i++) {
			list_contact[i].addEventListener('click', function () {
				var room_id = $(this).val();
				console.log(room_id);
				$.ajax({
					url: "{{route('applicant.show_message.by.room_id')}}",
					type: "GET",
					data: {
						room_id: room_id,
					},
					success: function (data) {
						console.log(data.data_html);
						$('.content').html(data.data_html);
					}
				});

			});
		}

		

		$(window).on('keydown', function (e) {
			if (e.which == 13) {
				newMessage();
				return false;
			}
		});
		//# sourceURL=pen.js
	</script>