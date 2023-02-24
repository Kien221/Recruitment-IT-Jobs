<div style="width:600px;margin:0 auto">
    <div style="text-align:center">
        <h2>Xin chào {{$hr->name}}</h2>
        <p>Bạn vừa đăng ký tài khoản trên website tuyển dụng IT</p>
        <p>Vui lòng click vào link bên dưới để kích hoạt tài khoản</p>
        <a href="{{route('active_account', ['token' => $hr->token,'hr_id'=> $hr->id])}}">Kích hoạt tài khoản</a>
    </div>

</div>