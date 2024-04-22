@section('title'){{'Tạo bài tuyển dụng'}} @endsection
    @include('layout.hrview.header_hr')
    <div class="main_hr_view">
        <div class="row">
            @include('layout.hrview.sidebar_hr')
            <div class="col-md-10">
                <div class="main_edit_profile" id="main_edit_profile">
                    <form action="{{route('update.post',$post->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            @if(session('update_post_success'))
                                <div class="alert alert-success text-center" style="margin-left:50px;margin-top:20px">
                                    {{session('update_post_success')}}
                                </div>
                            @endif
                            <div class="preliminary_info_post">
                                <h5 class="title_edit_form"><i class="fa-regular fa-pen-to-square"></i> THÔNG TIN CHUNG </h5>
                                <div class="post_info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Tên Công Ty (*)</label>
                                            <br>
                                            @if($company->name != null)
                                            <input type="text" placeholder="Nhập tên của công ty bạn" id="company_name" class="company_name_input" name="name_company" value="{{$company->name}}" disabled>
                                            @else
                                            <input type="text" placeholder="Nhập tên của công ty bạn" id="company_name" class="company_name_input" name="name_company" required>
                                            @endif
                                        </div>
                                        <div class="col-md-6" style="margin-top:30px">
                                                <span class="logo" style="margin-top:20px">
                                                @if($company->logo == null)
                                                    <label for="up_logo" class="custom-file-upload-logo">
                                                        <i class="fa fa-cloud-upload"></i> Chọn logo
                                                    </label>
                                                    <input type="file" id="up_logo" name="logo" name="logo">
                                                @endif
                                                    <img src="{{asset('storage/'.$company->logo)}}" alt="" id="logo_company" style="margin-left:15px">
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="post_info">
                                    <label for="" style="margin-bottom:10px">Ngôn Ngữ Tuyển Dụng (*)</label>
                                    <br>
                                    <select class="form-control" multiple="multiple" id="select-languages" name="languages[]" required="required">
                                        @foreach($post->languages as $language)
                                        <option value="{{$language}}" selected>{{$language}}</option>
                                        @endforeach
                                        <option value="PHP">PHP</option>
                                        <option value="ReactJS">ReactJS</option>
                                        <option value="Java">Java</option>
                                        <option value="C#">C#</option>
                                        <option value="C/C++">C/C++</option>
                                        <option value="VueJs">VueJs</option>
                                        <option value="Angular">Angular</option>
                                        <option value="Nodejs">Nodejs</option>
                                    </select>
                                </div>
                                <div class="post_info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="city">
                                                <label for="" style="margin-bottom:10px">Thành Phố(*)</label>
                                                <br>
                                                <select class="form-control" id="select-city" name="city" required="required"> 
                                                    <option value="{{$post->city}}" selected>{{$post->city}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="district">
                                                <label for="" style="margin-bottom:10px">Quận / Huyện(*)</label>
                                                    <br>
                                                <select class="form-control" id="select-district" name="district" required="required">   
                                                    <option value="{{$post->district}}" selected>{{$post->district}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="post_info">
                                   <div class="row">
                                        <div class="col-md-6">
                                            <label for="" style="margin-bottom:10px">Vị trí tuyển dụng(*)</label>
                                                <br>
                                            <select class="form-control" multiple="multiple" id="select-position-apply" name="position[]" required="required">
                                                @foreach($post->position as $each)
                                                <option value="{{$each}}" selected>{{$each}}</option>
                                                @endforeach
                                                <option value="intern">intern</option>
                                                <option value="fresher">fresher</option>
                                                <option value="junior">junior</option>
                                                <option value="senior">senior</option>
                                                <option value="leader">leader</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Hình thức làm việc</label>
                                                <br>
                                            <select name="work_type" id="" class="choice_unit_money" required="required">
                                                <option value="{{$post->work_type}}" selected>{{$post->work_type}}</option>
                                                <option value="part-time">part-time</option>
                                                <option value="full-time">full-time</option>
                                                <option value="full-time && part-time">full-time & part-time</option>
                                            </select>
                                        </div>
                                   </div>
                                </div>
                                <div class="post_info">
                                   <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Mức lương tối thiểu(*)</label>
                                                <br>
                                            <input type="text"  class="company_name_input" name="min_salary" value="{{$post->min_salary}}" required="required">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Mức lương tối đa(*)</label>
                                                <br>
                                            <input type="text" class="company_name_input" name="max_salary" value="{{$post->max_salary}}" required="required">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Đơn vị(*)</label>
                                                <br>
                                            <select name="unit_money" id="" class="choice_unit_money" required="required">
                                                <option value="{{$post->unit_money}}" selected>{{$post->unit_money}}</option>
                                                <option value="VND">VND</option>
                                                <option value="$">$</option>
                                            </select>
                                        </div>
                                   </div>
                                </div>
                                <div class="post_info">
                                   <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Số lượng ứng viên(*)</label>
                                                <br>
                                            <input type="text" class="company_name_input" name="number_of_recruitment" value="{{$post->number_of_recruitment}}" required="required">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Ngày hết hạn(*)</label>
                                                <br>
                                            <input type="date" class="company_name_input" name="expired_post" value="{{$post->expired_post}}" required="required">
                                        </div>
                                   </div>
                                </div>
                                <div class="post_info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="city">
                                                <label for="">Tiêu Đề</label>
                                                <br>
                                                <input type="text"  class="company_name_input" name="title" value="{{$post->title}}" style="background-color:white;" id="title" required="required">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="district">
                                                <label for="">Slug</label>
                                                    <br>
                                                <input type="text" id="slug"  class="company_name_input" name="slug" value="{{$post->slug}}" style="background-color:white;" required="required">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="introduce_yourself_form hooby" id="your_hooby">
                                <h5 class="title_edit_form"><i class="fa-regular fa-pen-to-square"></i> MÔ TẢ CÔNG VIỆC </h5>
                                    <textarea name="description"  id="editor1" rows="10"  placeholder="giới chịu đôi chút về bản thân VD( nơi sinh, tuổi tác, đam mê nghề nghiệp như nào, sở thích)">
                                        <div>
                                            {{$post->description}}
                                        </div>
                                    </textarea>
                                    <script>
                                        CKEDITOR.replace( 'editor1' );
                                    </script>
                            </div>
                            <div class="introduce_yourself_form hooby" id="your_study">
                                <h5 class="title_edit_form"><i class="fa-solid fa-graduation-cap"></i></i> YÊU CẦU ỨNG VIÊN </h5>
                                    <textarea name="requirement" id="editor2" rows="10" placeholder="giới chịu đôi chút về bản thân VD( nơi sinh, tuổi tác, đam mê nghề nghiệp như nào, sở thích)">
                                        <div>
                                            {{$post->requirement}}
                                        </div>
                                    </textarea>
                                    <script>
                                        CKEDITOR.replace( 'editor2' );
                                    </script>
                            </div>
                            <div class="introduce_yourself_form exp" id="your_exp">
                                <h5 class="title_edit_form"><i class="fa-solid fa-briefcase"></i> QUYỀN LỢI ĐƯỢC HƯỞNG </h5>
                                    <textarea name="benefit" id="editor3" rows="10" placeholder="giới chịu đôi chút về bản thân VD( nơi sinh, tuổi tác, đam mê nghề nghiệp như nào, sở thích)">
                                        <div>
                                            {{$post->benefit}}
                                        </div>
                                    </textarea>
                                    <script>
                                        CKEDITOR.replace( 'editor3' );
                                    </script>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="btn_create_post">
                                    <button class="btn_create_post" type="submit">Lưu thay đổi</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(async function(){
            //i want to show array languagues from $post on view 
            var languages = @json($post->languages);
            console.log(languages);
            var data = $.map(languages, function (language) {
                return { id: language, text: language };
            });

            $('#select-languages').select2({
                data: data
            });
            async function loadDistrict(){
                const city = $("#select-city option:selected").data('path');
                const response = await fetch('{{asset('locations/')}}' + city);
                const districts = await response.json();
                $.each(districts.district, function (index,each){
                     $('#select-district').append(`
                     <option value='${each.name}'>${each.name}</option>
                     `);
                })
            };
            async function loadCity(){
                const countries = $("#select-city option:selected").val();
                const response = await fetch('{{asset('locations/test.json')}}');
                const districts = await response.json();
                $.each(districts, function (index,each){
                    if(index == countries){
                        $.each(each, function (index,each){
                            $('#select-district').append(`
                            <option value='${each}'>${each}</option>
                            `);
                        })
                    }
                    //  $('#select-district').append(`
                    //  <option value='${each.name}'>${each.name}</option>
                    //  `);
                })
            };
            function generateTitle(){
                const city = $("#select-city option:selected").val();
                let languages = [];
                let positions = [];
                const selected_languages = $("#select-languages option:selected").map(function(i, v){
                    languages.push($(v).text());
                })
                const selected_postion = $("#select-position-apply option:selected").map(function(i ,v){
                    positions.push($(v).text());
                })
                const company = $("#company_name").val();
                position = positions.join(',');
                languages = languages.join(',');    
                let string = `(${city})-${languages} - ${company}`;
                if(positions.length > 0){
                    string = `(${city})-${position}-${languages} - ${company}`;
                }
                $('#title').val(string);
                let title = $('#title').val();
                generateSlug(title);
               $('#title').change(function(){
                    let title = $('#title').val();
                    generateSlug(title);
                });
            }
            function generateSlug(title){
                $.ajax({
                    url : '{{route('api.post.slug')}}',
                    type: 'GET',
                    dataType: 'json',
                    data : {title},
                    success:(function(response){
                        $('#slug').val(response.slug);
                    }),
                    error:(function(error){
                        console.log(error);
                    })
                })     
            }
            $('#select-city').select2();
            $('#select-district').select2({
                tags: true,
            });
             //const response = await fetch('{{asset('locations/test.json')}}');
            const response = await fetch('{{asset('locations/index.json')}}');
            const cities = await response.json();
            $.each(cities, function (index, each){
                
                $('#select-city').append(`
                <option value='${index}' data-path='${each.file_path}'>${index}</option>
                `);
                // $('#select-city').append(`
                // <option value='${index}'>${index}</option>
                // `);

            })

            //loadCity()
            loadDistrict();
            $('#select-city').change(function(){
                $('#select-district').empty();
                 loadDistrict();
                //loadCity();
            })
            $("#select-company,#select-languages,#select-position-apply").select2({
            tags: true
            });
            $(document).on('change', '#select-languages , #select-city , #company_name , #select-position-apply', function(){
                let city = $("#select-city option:selected").val();
                generateTitle();
            });

        })
    </script>