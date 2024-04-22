
<ul style="list-style:none;">
                @foreach($rooms_chat_of_applicant as $room_chat_of_applicant)
				@if($room_chat_of_applicant->from == 1)
				 @if($room_chat_of_applicant->status == 0)
                 <li class="contact" style="background-color:lightslategray;margin-top:5px" value="{{$room_chat_of_applicant->room_id}}">
				 @else
				 <li class="contact" style="margin-top:5px" value="{{$room_chat_of_applicant->room_id}}">
				 @endif
				@else
				<li class="contact" style="margin-top:5px" value="{{$room_chat_of_applicant->room_id}}">
				@endif
					<div class="wrap">
						<span class="contact-status online"></span>
						<img src="{{asset('storage/'.$room_chat_of_applicant->company_logo)}}" alt="" style="width:45px;height:45px;"/>
						@if($room_chat_of_applicant->from == 1 && $room_chat_of_applicant->status == 0)
						<div class="meta" style="color:black">
						@else
						<div class="meta">
						@endif
							<p class="name">{{$room_chat_of_applicant->company_name}}</p>
							@if($room_chat_of_applicant->from == 0)
							<p class="preview">Bạn : {{$room_chat_of_applicant->last_message}}</p>
							@else
							<p class="preview">{{$room_chat_of_applicant->last_message}}</p>
							@endif
						</div>
					</div>
				</li>
                @endforeach
			</ul>