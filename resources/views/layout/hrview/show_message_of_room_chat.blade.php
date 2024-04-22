<div class="contact-profile">
	<img src="{{asset('storage/'.$applicant_info->applicant_avatar)}}" alt="" style="width:45px;height:45px;" />
	<p>{{$applicant_info->applicant_name}}</p>
	<div class="social-media">
		<i class="fa fa-facebook" aria-hidden="true"></i>
		<i class="fa fa-twitter" aria-hidden="true"></i>
		<i class="fa fa-instagram" aria-hidden="true"></i>
	</div>
</div>
<div class="messages" id="messages">
	@if($text_message->count() == 0)
	<p style="text-align:center;margin-top:20px;font-size:18px" id="none_message">Hãy bắt đầu cuộc trò chuyện bằng một
		lời chào 😍</p>
	<ul id="list_messages">
	</ul>
	@else
	<ul id="list_messages">
		@foreach($text_message as $message)
		@if($message->from == 1)
		<li class="sent">
			<img src="{{asset('storage/'.$message->company_logo)}}" alt="" style="width:30px;height:30px" />
			<p>{{$message->text_message}}</p>
		</li>
		@else
		<li class="replies">
			<img src="{{asset('storage/'.$applicant_info->applicant_avatar)}}" alt="" style="width:30px;height:30px" />
			<p>{{$message->text_message}}</p>
		</li>
		@endif
		@endforeach
	</ul>
	@endif
</div>
<div class="message-input">
	<div class="wrap">
		<input type="text" placeholder="Write your message..." class="input-text-chatting" />
		<i class="fa fa-paperclip attachment" aria-hidden="true"></i>
		<button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
	</div>
</div>
<script>
	$(".input-text-chatting").click(function () {
		var room_id = '{{$room_id}}';
		var tag_li_with_room_id_value = $('li[value="' + room_id + '"]');
		var meta_class = tag_li_with_room_id_value.find('.meta');
		var backgroundColor = tag_li_with_room_id_value.css('background-color');
		console.log(backgroundColor);
		if (backgroundColor === 'rgb(119, 136, 153)') {
			tag_li_with_room_id_value.css('background-color', 'transparent');
			meta_class.css('color', 'white');
		}
		hr_id = '{{session('id_hr')}}';
		var token = "{{csrf_token()}}";
		$.ajax({
			url: "{{route('hr.seen.message')}}",
			type: "POST",
			data: {
				_token: token,
				room_id: room_id,
				hr_id: hr_id,
				from_to: 1
			},
			success: function (data) {
				console.log("ok", data);
				$.ajax({
                                            url:'{{route('count.chatting.messages.not.seen')}}',
                                            type:'GET',
                                            dataType:'json',
                                            data:{
                                                hr_id:hr_id,
                                                from_to: 1
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
	
		},
	error: function(error) {
		console.log(error);
	}
	});

})
	function scrollToBottom() {
		var messages = document.getElementById('messages');
			messages.scrollTop = messages.scrollHeight;
	}
	scrollToBottom();
	$('.submit').click(function () {
		var text_message = $('.message-input input').val();
		console.log(text_message);
		var room_id = {{ $room_id }};
	console.log(room_id);
	var applicant_id = {{ $applicant_info-> applicant_id}};
	console.log(applicant_id)
	var from = 1;
	var token = "{{csrf_token()}}";
	$.ajax({
		url: "{{route('hr.send_message')}}",
		type: 'POST',
		data: {
			_token: token,
			text_message: text_message,
			applicant_id: applicant_id,
			room_id: room_id,
			from: from,
		},
		dataType: "json",
		success: function (data) {
			var company_logo = data.company_info.company_logo;
			console.log(data);
			$('#none_message').css('display', 'none');
			$('#list_messages').append(
				`<li class="sent">
			<img src="{{asset('storage/${company_logo}')}}" alt="" style="width:30px;height:30px"/>
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