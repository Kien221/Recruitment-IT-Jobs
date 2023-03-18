@section('title')- {{'Cập nhật thông tin công ty'}} @endsection
    @include('layout.hrview.header_hr')
    <div class="main_hr_view">
        <div class="row">
            @include('layout.hrview.sidebar_hr')
            <div class="col-md-10">
                <div class="about_your_account">
                    <div class="setting-text">
                        <span>Cài đặt tài khoản</span>
                    </div>
                    @if(session('error'))
                    <div class="alert alert-danger text-center" style="margin-left:50px;margin-top:20px">
                        {{session('error')}}
                    </div>
                     @endif
                     @if(session('success'))
                    <div class="alert alert-success text-center" style="margin-left:50px;margin-top:20px">
                        {{session('success')}}
                    </div>
                     @endif
                     @if(session('success_update'))
                    <div class="alert alert-success text-center" style="margin-left:50px;margin-top:20px">
                        {{session('success_update')}}
                    </div>
                     @endif
                    <div class="main_setting">
                        <div class="main_setting_account">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="list_setting">
                                        <ul>
                                            <li> <a href="#" class="icon_link"><i class="fa-regular fa-user"></i>Thông tin cá nhân</a></li>
                                            <li>  <a href="#" class="icon_link"><i class="fa-regular fa-user"></i>Thông tin công ty</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="setting-account">
                                        <h5 class="company-text">Cập nhật thông tin công ty</h5>
                                        <div class="infor-company">
                                            <form action="{{route('store.company')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                        <div class="col-md-6">
                                                            <span class="logo">
                                                                Logo
                                                                @if($company['logo'] != null)
                                                                <img src="{{asset('storage/'.$company->logo)}}" alt="" id="logo_company">
                                                                @else
                                                                <img src="" alt="" id="logo_company">
                                                                @endif
                                                                <label for="up_logo" class="custom-file-upload-logo">
                                                                    <i class="fa fa-cloud-upload"></i> Chọn logo
                                                                </label>
                                                                <input type="file" id="up_logo" name="logo">
                                                            </span>
                                                            <div class="company_info">
                                                                <label for="">Tên công ty</label>
                                                                <br>
                                                                <input type="text" placeholder="Nhập tên công ty" class="company_name_input" name="name" value="{{$company->name ?? ''}}">
                                                            </div>
                                                            <div class="company_info">
                                                                <label for="">Mã số thuế</label>
                                                                <br>
                                                                <input type="text" placeholder="Nhập mã thuế công ty" class="tax_input" name="tax_code" value="{{$company->tax_code ?? ''}}">
                                                            </div>
                                                            <div class="company_info">
                                                                <label for="">Lĩnh vực hoạt động</label>
                                                           
                                                                </div>
                                                           <div class="major">
                                                                    <select name="industry" id="major_company_input" class="major_company_input" value="{{$company->industry ?? ''}}">
                                                                        <option value="IT-Phần mềm">IT-Phần mềm</option>
                                                                        <option value="IT-Phần cứng">IT-Phần cứng</option>
                                                                        <option value="Viễn thông">Viễn thông</option>
                                                                        <option value="Thương mại điện tử">Thương mại điện tử</option>
                                                                    </select>
                                                           </div>
                                                           <div class="company_info">
                                                               <label for="">Địa chỉ</label>
                                                               <br>
                                                               <input type="text" placeholder="Nhập địa chỉ của công ty" class="address_input" name="address" value="{{$company->address ?? ''}}">
                                                           </div>
                                                           <div class="company_info">
                                                               <label for="">Số điện thoại</label>
                                                               <br>
                                                               <input type="text" placeholder="Số điện thoại" class="tax_input" name="phone" value="{{$company->phone ?? ''}}">
                                                           </div>
                                                           <div class="company_info" id="up_images_company">
                                                               <label for="">Hình ảnh của công ty</label>
                                                               <br>
                                                               <label for="up_images" class="custom-file-upload-img-company">
                                                                <i class="fa fa-cloud-upload"></i> Up hình ảnh của công ty
                                                                </label>
                                                                <input type="file" id="up_images" name="images[]" multiple="true" accept="image/gif, image/jpeg, image/png"/>
                                                                <br>
                                                                @foreach($images as $image)
                                                                <img src="{{asset('storage/'.$image->image)}}" alt="" class="images_company" style="width: 40px;height: 40px;margin:10px 10px">
                                                                @endforeach
                                                                </br>
                                                           </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="company_info" id="company_info">
                                                                <label for="">Email</label>
                                                                <br>
                                                                <input type="email" placeholder="Nhập email của công ty" class="address_input" name="email" value="{{$company->email ?? ''}}">
                                                            </div>
                                                            <div class="company_info">
                                                                <label for="">Website</label>
                                                                <br>
                                                                <input type="text" placeholder="Link Website của công ty" class="tax_input" name="website" value="{{$company->website ?? ''}}">
                                                            </div>
                                                            <div class="company_info">
                                                                <label for="">Quy mô công ty</label>
                                                                <br>
                                                                <input type="text" placeholder="Số lượng nhân viên công ty" class="tax_input" name="number_of_employees" value="{{$company->number_of_employees ?? ''}}">
                                                            </div>
                                                            <div class="company_info">
                                                                <label for="">Mô tả công ty</label>
                                                                <textarea name="description_company" class="description_company" id="editor1" rows="10" cols="80" placeholder="giới chịu đôi chút về bản thân VD( nơi sinh, tuổi tác, đam mê nghề nghiệp như nào, sở thích)">
                                                                        <div>{{$company->description_company ?? ''}}</div>
                                                                </textarea>
                                                                <script>
                                                                    CKEDITOR.replace( 'editor1' );
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="submit_button">
                                                        @if($company['id'] == null)
                                                        <button type="submit" class="btn_save" >Lưu</button>
                                                        @else
                                                        <button type="submit" class="btn_save" onclick="if (!confirm('Xác nhận những thay đổi?')) { return false }" >Lưu</button>
                                                        @endif
                                                    </div>
                                            </form>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){
        $('#up_logo').change(function(){
            let file = $(this).prop('files')[0];
            let reader = new FileReader();
            reader.onload = function(){
                $('#logo_company').attr('src',reader.result);
            }
            reader.readAsDataURL(file);
        })
        $('#up_images').change(function(){
            if($('#up_images_company').children().length > 0){
                $('.images_company').remove();
            }
            let file_length = $(this).prop('files').length;
            for(let i = 0; i < file_length; i++){
                let file = $(this).prop('files')[i];
                let reader = new FileReader();
                reader.onload = function(){
                    $('#up_images_company').append(`<img src="${reader.result}" alt="" class="img_company" style="width: 40px;height: 40px;margin:10px 10px">`);
                }
                reader.readAsDataURL(file);
            }
        });
        $('.btn_save').click(function(){
            let name = $('.company_name_input').val();
            let tax_code = $('.tax_input').val();
            let address = $('.address_input').val();
            let phone = $('.phone_input').val();
            let email = $('.email_input').val();
            let website = $('.website_input').val();
            let number_of_employees = $('.number_of_employees_input').val();
            let description_company = $('.description_company').val();
            if(name == '' || tax_code == '' || address == '' || phone == '' || email == '' || website == '' || number_of_employees == '' || description_company == ''){
                alert('Vui lòng nhập đầy đủ thông tin');
                return false;
            }
        })
    });
</script>  
</body>
</html>