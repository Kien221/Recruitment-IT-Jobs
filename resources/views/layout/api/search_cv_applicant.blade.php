<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/public.css')}}">
    <link rel="stylesheet" href="{{asset('css/hr.css')}}">
    <link rel="stylesheet" href="{{asset('css/applicant.css')}}">
    <script src="{{asset('js/js.js')}}"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name')}} @yield('title')</title>
   
</head>
<body>     
               
            <i style="margin-bottom:20px"><b>{{$list_cv->count()}}</b> kết quả được tìm thấy</i>
            @foreach($list_cv as $cv)
            <div class="post_item">
                            <div class="row">
                                <div class="col-md-10 img-title_job-description">    
                                    <img src="{{asset('storage/'.$cv->applicant_avatar)}}" alt="">
                                    <div class="description-post">
                                        <h3 class="title-job"><a href="#">{{$cv->applicant_name}}</a></h3>
                                        <div class="btn-introduce-post" style="color:black;margin-bottom:0px;font-size:14px">Vị trí mong muốn ứng tuyển : <b>{{$cv->position_want_to_apply}} - {{$cv->languages_want_to_apply}}</b></div>
                                        <span class="btn-introduce-post" style="color:black;font-size:14px">Số năm kinh nghiệm : <b>{{$cv->exp_year_work}}</b></span>
                                        <br>
                                        <span class="btn-introduce-post" style="color:black;font-size:14px">Địa điểm mong muốn làm việc - <b>{{$cv->city_want_to_work}}</b></span>
                                        <br>
                                        @if($cv->typeCV == 'CV Upload')
                                            @if($account_hr->used_views == $level_account_hr->view_every_day)
                                            <span style="color:red">Bạn đã hết lượt xem hồ sơ ứng viên hôm nay, vui lòng quay lại vào hôm sau</span>
                                            @else
                                            <span class="btn-introduce-post" style="color:black;font-size:14px">Link CV : <a href="{{asset('storage/'.$cv->filecv)}}" class="cv_upload" onClick="watch_file_cv_upload()" target="_blank">{{$cv->filecv}}</a></span>
                                            @endif
                                        @else
                                            @if($account_hr->used_views == $level_account_hr->view_every_day)
                                            <span style="color:red">Bạn đã hết lượt xem hồ sơ ứng viên hôm nay, vui lòng quay lại vào hôm sau</span>
                                            @else
                                            <span style="color:blue;cursor:pointer;text-decoration:underline;" class="text_center" id="cv_web">Link CV {{$cv->applicant_name}}-{{$cv->applicant_email}}</span></td>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                <a href="{{route('contact_applicant',[$cv->id_applicant])}}" class="btn btn-primary btn-sm" style="color:white"><i class="fas fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>        
            @endforeach   
            
            <div class="form-apply" id="form-apply">
                <div id="content-cv_applicant">
                </div>
            </div>

        <script>
            $(document).ready(function(){
                    $('#cv_web').click(function(){
                    $('#form-apply').css('display','block');
                    $applicant_id = {{$cv->id_applicant}};
                    let route = '{{route('applicant.show.cv_web')}}';
                    $.ajax({
                        url:route,
                        method:'get',
                        data:{
                        applicant_id:$applicant_id,
                        },
                        dataType: 'json',
                        success:function(data){
                            $('#content-cv_applicant').html(data);
                            $('.close').click(function(){
                                $('#form-apply').css('display','none');
                            })

                        },
                        error:function(data){
                            console.log(data);
                        }
                    })
                })

                $('.cv_upload').click(function(){
                    $applicant_id = {{$cv->id_applicant}};
                    console.log($applicant_id);
                    $.ajax({
                                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                                url:'{{route('update_used_view')}}',
                                method:'post',
                                data:{
                                    applicant_id:$applicant_id,
                                },
                                dataType: 'json',
                                success:function(data){
                                    console.log(data);
                                },
                                error:function(data){
                                        console.log(data);
                                }
                            })
                })
            });
        </script>
</body> 