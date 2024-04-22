<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/public.css')}}">
    <link rel="stylesheet" href="{{asset('css/hr.css')}}">
    <link rel="stylesheet" href="{{asset('css/applicant.css')}}">
    <link rel="stylesheet" href="{{asset('js/js.js')}}">
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>NHÀ TUYỂN DỤNG</title>
</head>
<body>
    @include('layout.hrview.header_hr')
    <div class="main_hr_view">
        <div class="row">
            @include('layout.hrview.sidebar_hr')
            <div class="col-md-10">
                <div class="compete_text" style="border-bottom:5px solid #de8700;">
                        <h5>
                            <a href="{{route('post.detail',[$post->id,$post->slug])}}" style="color:green">{{$post->title}}</a>
                            <input type="hidden" value="{{$post->id}}" id="post_id">
                        </h5>
                </div>
              <table class="table table-bordered" id="customers">
                                  <thead>
                                      <tr>
                                        <th scope="col">Đánh dấu</th>
                                        <th scope="col">Họ và tên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Địa Chỉ</th>
                                        <th scope="col">Giới thiệu</th>
                                        <th scope="col">Link CV</th>
                                         <th scope="col">Tùy chọn</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($list_applicants as $applicant)
                                    <tr>
                                      <input type="hidden" value="{{$applicant->id}}" class="applicant_id">
                                      <td><input type="checkbox"></td>
                                      <td class="text_center">{{$applicant->name}}</td>
                                      <td class="text_center">{{$applicant->email}}</td>
                                      <td class="text_center">{{$applicant->city}}</td>
                                      <td class="text_center">{{$applicant->brief_introduce}}</td>
                                      @if($applicant->type_cv === 'cv_web')
                                      <td><span style="color:blue;cursor:pointer;text-decoration:underline;" class="text_center" id="cv_web">{{$applicant->name}}-{{$applicant->email}}</span></td>
                                      @else
                                      <td class="text_center"><a href="{{asset('storage/'.$applicant->file_cv)}}"  target="blank" onClick="watch_file_cv_upload()" class="cv_upload">{{$applicant->file_cv}}</a></td>
                                      @endif
                                      <td>
                                        <div class="btn-group success_accept" role="group" aria-label="Basic example">
                                          @if($applicant->status == 1)
                                          <button class="btn btn-success btn-sm" style="color:white" ><i class="fa-solid fa-check-double"></i></button>
                                          @elseif($applicant->status == 2)
                                          <button class="btn btn-danger btn-sm" style="color:white" ><i class="fa-sharp fa-regular fa-circle-xmark"></i></button>
                                          @else
                                          <button class="btn btn-success btn-sm accep_cv_btn" style="color:white"><i class="fa-regular fa-thumbs-up"></i></button>
                                          <button class="btn btn-danger btn-sm refuse_cv_btn" style="color:white"><i class="fa-sharp fa-regular fa-circle-xmark"></i></button>
                                          @endif
                                        </div>
                                      </td>
                                    
                                    </tr>

                                      @endforeach

                                  </tbody>

                          </tbody>
              </table>

            </div>

              <div class="form-apply" id="form-apply">
                <div id="content-cv_profile_topcv">
                </div>
            </div>
        </div>
    </div>
<script>
   $(document).ready(function(){
      $('#cv_web').click(function(){
        $('#form-apply').css('display','block');
        let applicant_id = $('.applicant_id').val();
        console.log(applicant_id);
        let route = '{{route('applicant.show.cv_web')}}';
        $.ajax({
            url:route,
            method:'get',
            data:{
              applicant_id: applicant_id,
            },
            dataType: 'json',
            success:function(data){
              console.log(data);
                $('#content-cv_profile_topcv').html(data);
                $('.close').click(function(){
                  $('#form-apply').css('display','none');
                })

            },
            error:function(data){
                console.log(data);
            }
          })
      })
      const list_accept_cv_btn = document.querySelectorAll('.accep_cv_btn');
      const list_refuse_cv_btn = document.querySelectorAll('.refuse_cv_btn');
      if(list_accept_cv_btn.length > 0){
        for(let i = 0 ; i<list_accept_cv_btn.length ; i++){
          list_accept_cv_btn[i].addEventListener('click',function(){
              $post_id = $('#post_id').val();
              const btn_accept = $(this).closest('.success_accept');
              $applicant_id = $(this).parent().parent().parent().find('.applicant_id').val();
              $.ajax({
                  headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                  url:'{{route('accept.applicant.cv')}}',
                  method:'put',
                  data:{
                    post_id:$post_id,
                    applicant_id:$applicant_id,
                  },
                  dataType:'json',
                  success:function(data){
                    btn_accept.html("");
                    btn_accept.append('<button class="btn btn-success btn-sm" style="color:white" id="accept_cv_btn"><i class="fa-solid fa-check-double"></i></button>');
                  },
                  error:function(error){
                    console.log(error);
                  }
                })
            })
        }
      }

      if(list_refuse_cv_btn.length > 0){
        for(let i = 0 ; i<list_refuse_cv_btn.length ; i++){
            list_refuse_cv_btn[i].addEventListener('click',function(){
              $post_id = $('#post_id').val();
              const btn_accept = $(this).closest('.success_accept');
              $applicant_id = $(this).parent().parent().parent().find('.applicant_id').val();
              $.ajax({
                  headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                  url:'{{route('refuse.applicant.cv')}}',
                  method:'put',
                  data:{
                    post_id:$post_id,
                    applicant_id:$applicant_id,
                  },
                  dataType:'json',
                  success:function(data){
                    btn_accept.html("");
                    btn_accept.append('<button class="btn btn-danger btn-sm" style="color:white" id="refuse_cv_btn"><i class="fa-sharp fa-regular fa-circle-xmark"></i></button>');
                  },
                  error:function(error){
                    console.log(error);
                  }
              })
          })
       }
      }

    })
</script>
</body>
</html>