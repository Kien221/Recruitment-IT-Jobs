<div class="post_by_city">
    @foreach($posts_by_city as $post_by_city)
        @if($post_by_city->borderpost == 1)
                            <div class="post_item" style="border:solid 5px green">
                            @else
                            <div class="post_item">
                            @endif
                                <div class="row">
                                    <div class="col-md-8 img-title_job-description">    
                                        <img src="{{asset('storage/'.$post_by_city->company_logo)}}" alt="">
                                        <div class="description-post">
                                            <h3 class="title-job"><a href="{{route('post.detail',[$post_by_city->id,$post_by_city->slug])}}">{{$post_by_city->title}}</a></h3>
                                            <div class="company-name">{{$post_by_city->company_name}}</div>
                                            <span class="btn-introduce-post" style="color:black;">{{$post_by_city->min_salary}} {{$post_by_city->unit_money}} - {{$post_by_city->max_salary}} {{$post_by_city->unit_money}}</span>
                                            <span class="btn-introduce-post" style="color:black;">Hết hạn - {{$post_by_city->expired_post}}</span>
                                            <span class="btn-introduce-post" style="color:black;">{{$post_by_city->city}}</span>
                                        </div>
                                        <!-- @foreach (json_decode($post_by_city->languages) as $languages)
                                                {{ $languages }}
                                        @endforeach -->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="post_time">{{  \Carbon\Carbon::parse($post_by_city->created_at)->diffForHumans() }}</div>
                                        <div class="icon_save_post"><i class="fa-solid fa-heart"></i></div>
                                    </div>
                                </div>
                            </div>        
                          @endforeach    
    <p>{!! $posts_by_city->links() !!}</p>  
</div>