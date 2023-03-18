@section('title')- {{'Danh sách bài tuyển dụng'}} @endsection
    @include('layout.hrview.header_hr')
    <div class="main_hr_view">
        <div class="row">
            @include('layout.hrview.sidebar_hr')
            <div class="col-md-10">
              @if(session('create_post_success'))
                <div class="alert alert-success text-center" style="margin-left:50px;margin-top:20px">
                        {{session('create_post_success')}}
                </div>
              @endif
              <table class="table table-bordered" id="customers">
                                  <thead>
                                      <tr>
                                        <th scope="col">Tên bài viết</th>
                                        <th scope="col">Ngày đăng</th>
                                        <th scope="col">Ngày hết hạn</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Người ứng tuyển</th>
                                         <th scope="col">Tùy chọn</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($posted as $post)
                                    <tr id="tr_table">
                                      <td class="text_center title_post"><a href="{{route('post.detail',[$post->id,$post->slug])}}" style="text-decoration:none;color:green">{{$post->title}}</a></td>
                                      <td class="text_center">{{$post->created_at}}</td>
                                      <td class="text_center">{{$post->expired_post}}</td>
                                      @if($post->is_expired == 1)
                                      <td class="text_center">
                                        <div class="unexpired">
                                            Còn hạn
                                          </div>
                                      </td>
                                      @else
                                      <td class="text_center">
                                        <div class="expired">
                                          Hết hạn
                                        </div>
                                      </td>
                                      @endif
                                      @if($post->applicant == 0)
                                      <td class="text_center">{{$post->applicant}} CV</td>
                                      @else
                                      <td class="text_center"><a href="{{route('show_applicant.apply',[$post->id,$post->slug])}}">{{$post->applicant}} CV</a></td>
                                      @endif
                                      @if($post->is_expired == 1)
                                      <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                          <a href="" class="btn btn-primary btn-sm" style="color:white"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </td> 
                                    @else
                                    <td>
                                      <div class="btn-group" role="group" aria-label="Basic example">
                                        <button id="btn_delete_post" class="btn btn-danger btn-sm" style="color:white"><i class="fas fa-trash"></i></button>
                                      </div>
                                  </td>
                                    @endif
                                    @endforeach   
                          </tbody>
                  </table>

            </div>
        </div>
    </div>
    <script>
      $(document).ready(function(){
        $('#btn_delete_post').click(function(){
          alert('Bạn có muốn xóa bài viết này không?');

        });
      })
    </script> 
