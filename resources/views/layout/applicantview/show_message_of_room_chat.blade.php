<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
	Pusher.logToConsole = true;
	var room_id = {{ $room_id }};
	var applicant_id = {{ $text_message[0]-> applicant_id}};
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
	var private_message_each_room = pusher.subscribe('Chatting-channel.' + room_id + '.' + applicant_id);
	private_message_each_room.bind('Chatting-event', function (data) {
		$('.messages ul').append('<li class="replies"><img src="{{asset('storage/'.$company_info->company_logo)}}" alt="" style="width:30px;height:30px"/><p>' + data.text_message + '</p></li>');
		scrollToBottom();
	});
</script>
<div class="contact-profile">
	<img src="{{asset('storage/'.$company_info->company_logo)}}" alt="" style="width:45px;height:45px;" />
	<p>{{$company_info->company_name}}</p>
	<div class="social-media">
		<i class="fa fa-facebook" aria-hidden="true"></i>
		<i class="fa fa-twitter" aria-hidden="true"></i>
		<i class="fa fa-instagram" aria-hidden="true"></i>
	</div>
</div>
<div class="messages" id="messages" style="overflow-y: scroll;">
	@if($text_message->count() == 0)
	<p style="text-align:center;margin-top:20px;font-size:18px">Hãy bắt đầu cuộc trò chuyện bằng một lời chào 😍</p>
	@else
	<ul id="list_messages">
		@foreach($text_message as $message)
		@if($message->from == 0)
		<li class="sent">
			<img src="{{asset('storage/'.$message->applicant_avatar)}}" alt="" style="width:30px;height:30px" />
			<p>{{$message->text_message}}</p>
		</li>
		@else
		<li class="replies">
			<img src="{{asset('storage/'.$company_info->company_logo)}}" alt="" style="width:30px;height:30px" />
			<p>{{$message->text_message}}</p>
		</li>
		@endif
		@endforeach
	</ul>
	@endif
</div>
<div class="message-input">
	<div class="wrap">
		<input type="text" placeholder="Write your message..." class="input-text-chatting"/>
		<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
		<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
	</div>
</div>
<script>
	function scrollToBottom() {
    var messages = document.getElementById('messages');
	    messages.scrollTop = messages.scrollHeight;
	}
	scrollToBottom();
	$(".input-text-chatting").click(function () {
		console.log('ok');
		var room_id = '{{$room_id}}';
		var tag_li_with_room_id_value = $('li[value="' + room_id + '"]');
		console.log(room_id,tag_li_with_room_id_value);
		var meta_class = tag_li_with_room_id_value.find('.meta');
		var backgroundColor = tag_li_with_room_id_value.css('background-color');
		console.log(backgroundColor);
		if (backgroundColor === 'rgb(119, 136, 153)') {
			tag_li_with_room_id_value.css('background-color', 'transparent');
			meta_class.css('color', 'white');
		}

		var applicant_id = '{{session('id_applicant')}}';
		var token = "{{csrf_token()}}";
		$.ajax({
			url: "{{route('user.seen.message')}}",
			type: "POST",
			data: {
				_token: token,	
				room_id: room_id,
				applicant_id: applicant_id,
				from_to: 0
			},
			success: function (data) {
				console.log("ok");
				$.ajax({
					url: '{{route('count.chatting.messages.not.seen')}}',
					type: 'GET',
					dataType: 'json',
					data: {
						hr_id: applicant_id,
						from_to: 0,
					},
					success: function (data) {
						console.log(data);
						if (data.count_chatting_message_not_seen == 0) {
							$('#count_chatting_not_seen').css('display', 'none');
						}
						else {
							$('#count_chatting_not_seen').css('display', 'block');
							$('#count_chatting_not_seen').html(data.count_chatting_message_not_seen);

						}
					},
					error: function (error) {
						console.log(error);
					}
				})
	
		},
	error: function(error) {
		console.log(error);
	}
	});
	});

	$('.submit').click(function () {
		var text_message = $('.message-input input').val();
		console.log(text_message);
		var room_id = {{ $room_id }};
		console.log(room_id);
		var hr_id = {{ $text_message[0]-> hr_id}};
		console.log(hr_id)
		var from = 0;
		var token = "{{csrf_token()}}";
		$.ajax({
			url: "{{route('applicant.send_message')}}",
			type: 'POST',
			data: {
				_token: token,
				text_message: text_message,
				hr_id: hr_id,
				room_id: room_id,
				from: from,
			},
			dataType: "json",
			success: function (data) {
				$('#list_messages').append(
					`<li class="sent">
				<img src="{{asset('storage/'.session('avatar'))}}" alt="" style="width:30px;height:30px"/>
				<p>`+ data.text_message + `</p>
			</li>
			`
				);
				scrollToBottom();
				$('.message-input input').val(null);
			},
			error: function (error) {
				console.log(error);
			}
		});
});

</script>