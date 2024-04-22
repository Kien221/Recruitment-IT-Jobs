@foreach($posts as $post)
            @if($post->borderpost == 1)
                            <div class="post_item" style="border:solid 5px green">
                            @else
                            <div class="post_item">
                            @endif
                                <div class="row">
                                    <input type="hidden" value="{{$post->id}}">
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
    <script>
        $(document).ready(function(){
           $('.icon_save_post').click(function(){
               $post_id = $(this).parent().parent().find('input').val();
               $.ajax({
                   headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                   url: "{{route('save.post')}}",
                   type: "POST",
                   data: {
                       post_id: $post_id,
                   },
                   success: function(data){
                          if(data.save_post_success){
                            alert(data.save_post_success);
                          }
                          else{
                            alert(data.save_post_fail);
                          }
                   }
               });
           });
        });
    </script>
