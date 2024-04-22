@section('title')- {{'Nhà Tuyển Dụng'}} @endsection
    @include('layout.hrview.header_hr')
    <div class="main_hr_view">
        <div class="row">
            @include('layout.hrview.sidebar_hr')
            <div class="col-md-10">
                <div class="cart" style="display:flex">

                    <div class="cart-title-left colum-8">
                            <div class="header-info">
                                <div class="colum-4">SẢN PHẨM</div>
                                <div class="colum-3">SỐ <br>LƯỢNG</div>
                                <div class="colum-3">TỔNG</div>
                            </div>
        
                            
                            <div class="cart-item">
                                <div class="colum-4">
                                    <div class="names-img">
                                    <div class="detail_introduce_company">
                                            <div class="name_company" style="text-align:center;color:red;">
                                                <a href="#" style="color:red;">{{$service->name}}</a>
                                            </div>
                                            <div class="describe">
                                                <div class="salary-time_post" style="padding:5px;margin-top:-5px">
                                                 <span style="font-size:16px">{{$service->introduce_service}}</span>
                                                </div>
                                                <div class="salary-time_post">
                                                    <span><i class="fa-solid fa-check"></i> Thời gian hiệu lực</span>
                                                    <span> {{$service->expired_service}}</span>
                                                </div>
                                                <div class="salary-time_post">
                                                    <span><i class="fa-solid fa-check"></i> Số lượt tìm kiếm/ngày</span>
                                                    <span> {{$service->search_every_day}}</span>
                                                </div>
                                                <div class="salary-time_post">
                                                    <span><i class="fa-solid fa-check"></i> Số lượt xem CV/ngày</span>
                                                    <span> {{$service->view_every_day}} </span>
                                                </div>
                                                <div class="salary-time_post">
                                                    <span><i class="fa-solid fa-check"></i> Khung viền cho bài post</span>
                                                    <span><i class="fa-solid fa-check"></i></span>
                                                </div>
                                                <div class="salary-time_post">
                                                    <span><i class="fa-solid fa-check"></i> công ty nổi bật</span>
                                                    <span><i class="fa-solid fa-check"></i></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="colum-3">
                                    <div class="count">
                                        <input type="number" class="quantity-box">
                                    </div>  
                                </div>
                                <div class="colum-3">
                                    <div class="count">
                                        <p>{{number_format($service->price)}}<br> VND</p>
                                    </div>
                                </div>
                            </div>
        
                        </div>
                        <div class="bill-tt" style="background-color:#f2fbf6">
                                <div class="title-bill colum-10">
                                    <h6>TÓM TẮT ĐƠN HÀNG</h6>
                                </div>
                                <div class="expense-bill colum-10">
                                    <p>Chi phí đơn hàng = Giá trị đơn hàng - Mã Khuyến Mãi</p>
                                </div>
                                <div class="fee colum-10">
                                    <div class="value-title colum-6-5">
                                        <span>Giá Trị Đơn Hàng</span>
                                    </div>
                                   
                                    <div class="value colum-3-5">
                                        <span>{{number_format($service->price)}} VND</span>
                                    </div>
                                </div>
        
                                <div class="fee colum-10">
                                    <div class="value-title colum-6-5">
                                        <span>Mã giảm giá</span>
                                    </div>
                                    <div class="colum-2-5"></div>
                                    <div class="value colum-3-5">
                                        <span>0 VND</span>
                                    </div>
                                </div>
                                <div class="fee colum-10">
                                    <div class="value-title colum-6-5">
                                        <span>Tổng Chi Phí</span>
                                    </div>
                                   
                                    <div class="value colum-3-5">
                                        <span class="count-fee">{{number_format($service->price)}} VND</span>
                                    </div>
                                </div>
                                <div class="footer-info">
                                <div class="back-pay">
                                    <div class="pay colum-2-5" style="width:100%;text-align:center;padding-top:50px">
                                            <form action="{{route('payment',$service->id)}}" method="POST">
                                                @csrf
                                                <button class="btn-pay" name="redirect">THANH TOÁN <i class="fa-solid fa-chevron-right"></i></button>
                                            </form>
                                        </div>
                                </div>
                            </div>
                            </div>
                </div>
 
            </div>
        </div>
    </div>
