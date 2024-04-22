
			<ul style="list-style:none;">
                @foreach($rooms_chat_of_hr as $room_chat_of_hr)
				@if($room_chat_of_hr->from == 0)
				 @if($room_chat_of_hr->status == 0)
                 <li class="contact" style="background-color:lightslategray;margin-top:5px" value="{{$room_chat_of_hr->room_id}}">
				 @else
				 <li class="contact" style="margin-top:5px" value="{{$room_chat_of_hr->room_id}}">
				 @endif
				@else
				<li class="contact" style="margin-top:5px" value="{{$room_chat_of_hr->room_id}}">
				@endif
					<div class="wrap">
						<span class="contact-status online"></span>
						<img src="{{asset('storage/'.$room_chat_of_hr->applicant_avatar)}}" alt="" style="width:45px;height:45px;"/>
						@if($room_chat_of_hr->from == 0 && $room_chat_of_hr->status == 0)
						<div class="meta" style="color:black">
						@else
						<div class="meta">
						@endif
							<p class="name">{{$room_chat_of_hr->applicant_name}}</p>
							@if($room_chat_of_hr->from == 1)
							<p class="preview">Bạn : {{$room_chat_of_hr->last_message}}</p>
							@else
							<p class="preview">{{$room_chat_of_hr->last_message}}</p>
							@endif
						</div>
					</div>
				</li>
                @endforeach
			</ul>