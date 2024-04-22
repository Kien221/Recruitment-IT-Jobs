@section('title'){{'Thông tin chi tiết email'}} @endsection
    @include('layout.hrview.header_hr')
    <div class="main_hr_view">
        <div class="row">
            @include('layout.hrview.sidebar_hr')
            <div class="col-md-10">
                <div class="container bootdey">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title" style="font-size:23px">
                            <img src="https://static.topcv.vn/v4/image/logo/topcv-logo-tet-holiday.png" alt="" height="30px">
                        {{ $detail_email->title }}
                    </h2>
                    </div>
                    <div class="card-body">
                        <p>{!! $detail_email->content !!}</p>
                    </div>
                </div>
                            
            </div>
        </div>
    </div>
