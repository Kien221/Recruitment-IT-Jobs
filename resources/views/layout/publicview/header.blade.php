
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{asset('css/public.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css "/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Tuyển dụng IT</title>
</head>
<body>
    <div id="header">
           <div class="top-header">
               <div class="top-header-left">
                   <a href="">
    
                       <img src="{{asset('image/Logo_TopCV_no_slogan.png')}}" alt="" class="logo">
                   </a>
                   <h1 class="text-header"><span>Việc Làm</span> IT Hàng Đầu</h1>
               </div>
               <div class="top-header-right">
                   <ul class="list-info">
                       <li class="number_phone">
                           <a href="#"><i class="fa-solid fa-phone"></i> 0395004764</a>
                           <p class="space">|</p>
                       </li>
                       <li class="post_text">
                           <a href="#">
                               <i class="fa-solid fa-feather"></i> Đăng tin
                           </a> 
                           <p class="space">|</p>
                               
                       </li>
                       <li class="contact">
                           <a href="#">
    
                               <i class="fa-solid fa-address-book"></i> Liên hệ
                           </a>
                       </li>
                   </ul>
               </div>
           </div>
         <div class="middle-header">
           <div class="container-fluid">
               <div class="row">
                   <div class="col-md-6">
                       <div class="left">
    
                           <ul class="list-menu">
                               <li class="menu">
                                   <a href="">
                                       <i class="fa-solid fa-bars"></i>
                                   </a>
                               </li>
                               <li class="menu">
                                   <a href="#">Việc làm IT</a>
                               </li>
                               <li class="menu">
                                   <a href="{{route('applicantView')}}">Tạo CV</a>
                               </li>
                               <li class="menu">
                                   <a href="#">Công Ty IT</a>
                               </li>
                               <li class="menu">
                                   <a href="#">Blog IT</a>
                               </li>
                               <li class="menu">
                                   <a href="#">Liên hệ</a>
                               </li>
                           </ul>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="right">
                           <ul class="list-menu">
                               <li class="menu">
                                   <a href="{{route('login')}}" class="login-button">Đăng nhập</a>
                               </li>
                               <li class="menu">
                                   <a href="{{route('signup')}}" class="signin-button">Đăng ký</a>
                               </li>
                               <li class="menu">
                                   <a href="../hr_view/index.html" class="post-button">Đăng Tuyển & Tìm Hồ Sơ</a>
                               </li>
                           </ul>
    
                       </div>
                   </div>
               </div>
    
           </div>
         </div>
         <div class="end-header">
               
                 <div class="row">
                     <div class="col-md-4">
                         <div class="search-input">
                             <input type="text" placeholder="Tìm kiếm công việc,vị trí bạn mong muốn">
                         </div>
                     </div>
                     <div class="col-md-2">
                         <div class="fillter">
                             <span class="icon-header_fillter">
                                 <i class="fa-solid fa-building"></i>
                             </span>
                             <select name="" id="">
                                 <option value=""> Vị trí công việc</option>
                             </select>
                         </div>
                     </div>
                     <div class="col-md-2">
                         <div class="fillter">
                             <span class="icon-header_fillter">
                                 <i class="fa-solid fa-building"></i>
                             </span>
                             <select name="" id="">
                                 <option value=""> Vị trí công việc</option>
                             </select>
                         </div>
                     </div>
                     <div class="col-md-2">
                         <div class="fillter">
                             <span class="icon-header_fillter">  
                                 <i class="fa-solid fa-location-dot"></i>
                             </span>
                             <select name="" id="">
                                 <option value="">Địa Điểm</option>
                             </select>
                         </div>
                     </div>
                     <div class="col-md-2">
                         <div class="fillter search_header">
                            <i class="fa-solid fa-magnifying-glass"></i> Tìm Kiếm
                         </div>
                     </div>
                 </div>
    
         </div>
       </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>