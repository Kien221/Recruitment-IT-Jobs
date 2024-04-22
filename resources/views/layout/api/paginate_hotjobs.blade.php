@foreach($hot_jobs as $hot_job)
                @if($hot_job->borderpost == 1)
                                    <div class="job_item" style="border:solid 5px red;">
                                    @else
                                    <div class="job_item">
                                    @endif
                                        <span class="name-company-job">{{$hot_job->company_name}}</span>
                                        <div class="job_title"><a href="{{route('post.detail',[$hot_job->id,$hot_job->slug])}}">{{$hot_job->title}}</a></div>
                                        <div class="salary">{{$hot_job->min_salary}}{{$hot_job->unit_money}}-{{$hot_job->max_salary}}{{$hot_job->unit_money}} <i class="fa-solid fa-bookmark"></i></div>
                                    </div>
                                    @endforeach
                                    {!!$hot_jobs->links()!!}