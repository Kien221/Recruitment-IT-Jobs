
                               <ul>
                                    @if($list_message->count() != 0)
                                        @foreach($list_message as $message)
                                        @if($message->status == 0)
                                            <li class="message not_seen_message " value="{{$message->message_id}}">    
                                        @else
                                            <li class="message" value="{{$message->message_id}}">
                                        @endif                                           
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div  class="content-message">
                                                            @if($message->company_logo != null)
                                                                <img src="{{asset('storage/'.$message->company_logo)}}" alt="">
                                                            @else
                                                            <img src="#" alt="">
                                                            @endif
                                                            <div class="text-message">
                                                                <a href="{{route('jobs.apply.view')}}" style="color:black">
                                                                    {{$message->message}}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="time-message">
                                                            {{  \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        <li>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div  class="content-message">
                                                        <div class="text-message">
                                                            Bạn chưa có tin nhắn nào
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
