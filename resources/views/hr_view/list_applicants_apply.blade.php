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
                <div class="compete_text">
                        <h5 style="color:green">
                            {{$post->title}}
                        </h5>
                </div>
              <table class="table table-bordered" id="customers">
                                  <thead>
                                      <tr>
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
                                      <input type="hidden" value="{{$applicant->id}}" id="applicant_id">
                                      <td class="post_text_center">{{$applicant->name}}</td>
                                      <td class="post_text_center">{{$applicant->email}}</td>
                                      <td class="post_text_center">{{$applicant->city}}</td>
                                      <td class="post_text_center">{{$applicant->brief_introduce}}</td>
                                      @if($applicant->type_cv === 'cv_web')
                                      <td><span style="color:blue;cursor:pointer;text-decoration:underline;" id="cv_web">{{$applicant->name}}-{{$applicant->email}}</span></td>
                                      @else
                                      <td><a href="{{asset('storage/'.$applicant->file_cv)}}" target="blank">{{$applicant->file_cv}}</a></td>
                                      @endif
                                    </tr>
                                      @endforeach
                                  </tbody>

                          </tbody>
                  </table>

            </div>

              <div class="form-apply" id="form-apply">
                <div id="content-cv">
                </div>
            </div>
        </div>
    </div>
<script>
   $(document).ready(function(){
      $('#cv_web').click(function(){
        $('#form-apply').css('display','block');
        $applicant_id = $('#applicant_id').val();
        let route = '{{route('applicant.show.cv_web')}}';
        $('#cv_web').attr('href',route);
        $.ajax({
            url:route,
            method:'get',
            data:{
              applicant_id:$applicant_id,
            },
            dataType: 'json',
            success:function(data){
                $('#content-cv').html(data);
                $('.close').click(function(){
                  $('#form-apply').css('display','none');
                })

            },
            error:function(data){
                console.log(data);
            }
          })
      })
   })
</script>
</body>
</html>