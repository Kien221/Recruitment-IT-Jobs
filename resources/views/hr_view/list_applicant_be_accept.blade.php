@section('title')- {{'Danh sách ứng cử viên đã duyệt'}} @endsection
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
                                        <th scope="col">Tên ứng cử viên</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Giới Tính</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Tỉnh</th>
                                        <th scope="col">Nhắn tin</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($list_applicants_accepted as $applicant)
                                      <tr>
                                        <td>
                                            <a href="" style="text-decoration:none;color:green">{{$applicant->name}}</a>
                                        </td>
                                        <td>
                                            {{$applicant->email}}
                                        </td>
                                        <td>
                                            {{$applicant->gender}}
                                        </td>
                                        <td>
                                            {{$applicant->phoneNumber}}
                                        </td>
                                        <td>
                                            {{$applicant->city}}
                                        </td>
                                        <td>
                                            <a href="{{route('contact_applicant',[$applicant->id])}}" class="btn btn-primary btn-sm" style="color:white"><i class="fas fa-envelope"></i></a>
                                        </td>
                                      </tr>
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
