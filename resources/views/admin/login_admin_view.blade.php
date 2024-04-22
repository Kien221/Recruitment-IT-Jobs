<!DOCTYPE html>
<html>
<head>
	<title>Admin TopCV</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
	<link rel="stylesheet" type="text/css" href="{{asset('css/style_login.css')}}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{asset('css/demo.css')}}" rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

@include('layout.admin.header_login')

	<div class="main">	
				<div class="container">

					<div class="row justify-content-center">
						<div class="main-form col-md-6 col-lg-5">
							<div class="login-wrap p-4 p-md-5">
								<div class="icon d-flex align-items-center justify-content-center">
									<span class="fa fa-user-o"></span>
								</div>
								<h3 class="text-center mb-4">Đăng nhập Admin</h3>
								<form class="login-form" method="post" action="{{route('admin.checkLogin')}}">
									@csrf
									@if(session('error_pw_password'))
										<div class="error_password" style="color:red">
										{{session('error_pw_password')}}
										</div>
									@endif
									<div class="form-group">
										<input type="text" class="form-control rounded-left" placeholder="email" required="" name="email" id="Ma_So">
									</div>
									<div class="form-group d-flex">
										<input type="password" class="form-control rounded-left" placeholder="Password" required="" name ="password">
									</div>
								
									<div class="form-group d-flex capcha">
									<input type="text" class="form-control " placeholder="Mã bảo vệ" required="" width="50%" name="captcha" >
<img src="<?php echo ($captcha) ?>" width="50%">
									</div>
									@if(session('error_captcha'))
										<div class="error_captcha" style="color:red">
										{{session('error_captcha')}}
										</div>
									@endif
									<div class="form-group d-md-flex">
										<div class="w-50">
											<label class="checkbox-wrap checkbox-primary">Nhớ mật khẩu
												<input type="checkbox" checked="">
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary rounded submit p-3 px-5">Đăng nhập</button>
									</div>
								</form>
							</div>
					
					</div>
					</div>
            </div>
<script>
	$(document).ready(function(){
		$("#Ma_So").focus(function(){
			$(".error_password").hide();
			$(".error_captcha").hide();
		});
	});
</script>

</body>
</html>