            <span class="close" style="color: red;float: right;font-size: 30px;margin-top: -30px;margin-right: -16px;">
                    <i class="fa-sharp fa-solid fa-xmark"></i>
            </span>
            <i style="margin-bottom:20px"><b>{{$posts->count()}}</b> kết quả được tìm thấy</i>
            @foreach($posts as $post)
            <div class="post_item">
                            <div class="row">
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