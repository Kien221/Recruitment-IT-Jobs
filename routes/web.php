<?php
use App\Http\Controllers\adminController;
use App\Models\LevelAccount;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApplyCvController;
use App\Http\Controllers\MessageController;
use App\Models\Applicant;
use App\Http\Middleware\loginApplicant;
use App\Http\Middleware\loginHr;
use App\Http\Middleware\loginAdmin;
use App\Http\Controllers\chattingController;
use App\Http\Controllers\roomChatsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SubCvController;
use App\Http\Controllers\LevelAccountController;
use App\Http\Controllers\ReportPostController;
use Gregwar\Captcha\CaptchaBuilder;
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/login',function(){
    return view('form.login');
})->name('login');

Route::get('/signup-applicant',function(){
    return view('form.resignation_applicant');
})->name('signup.applicant');
Route::get('/signup-hr',function(){
    return view('form.resignation_hr');
})->name('signup.hr');
Route::get('/auth/redirect/{provider}', function ($provider) {
    return Socialite::driver($provider)->redirect();
})->name('auth.social');
Route::post('/signup/applicant',[ApplicantController::class,'store'])->name('register.applicant');

Route::get('/auth/callback/{provider}', function ($provider) {
    $user = Socialite::driver($provider)->stateless()->user();
    $query = Applicant::where('id',$user->getId())->first();
    if($query){
        $call_user = Applicant::where('id',$query->id)->first();
        $count_message = DB::table('messages')
                            ->join('apply_cvs','messages.apply_cvs_id','=','apply_cvs.id')
                            ->where('apply_cvs.applicant_id',$call_user->id)
                            ->where('messages.status',0)
                            ->count();
        session()->put('success_login_applicant','success_login_applicant');
        session()->put('id_applicant',$call_user->id);
        session()->put('applicant_name',$call_user->name);
        session()->put('avatar',$call_user->avatar);
        session()->put('count_message',$count_message);
        if(session('post_id') != null){
            return redirect()->route('post.detail',[session('post_id'),session('slug')]);
        }
        else if(session('post_id') == null){
            return redirect()->route('home');
        }
    }
    else{
        $new_user = new Applicant;
        $data= [
            'id'   => $user->getId(),
            'name' => $user->getNickname(),
            'email' => $user->getEmail(),
            'avatar' => $user->getAvatar(),
            'password' => $user->getId(),
        ];
        $new_user->fill($data);
        $new_user->save();
        session()->put('success_login_applicant','success_login_applicant');
        session()->put('id_aplicant',$new_user->id);
        session()->put('applicant_name',$new_user->name);
        session()->put('avatar_newuser',$new_user->avatar);
        return redirect()->route('home');
    }
});
Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('home');
})->name('logout');

Route::group([
    'middleware'=>loginApplicant::class,
],function(){
    Route::get('/cv-Applicant-view.html',[ApplicantController::class,'edit_cv_view'])->name('applicantView');
    Route::put('/update/infor/applicant/{user_id}.html',[ApplicantController::class,'update_cv'])->name('update.cv.applicant');
    Route::put('/update/infor/applicant',[SubCvController::class,'update_sub_cv'])->name('update.sub_cv.applicant');
    Route::put('/update/status/public/cv',[ApplicantController::class,'update_status_public_cv'])->name('update.status.public.cv');
    Route::get('/applicant/view/index',[ApplicantController::class,'index'])->name('applicant.index.view');
    Route::get('/applicant/view/jobs_apply_view',[ApplicantController::class,'jobs_apply_view'])->name('jobs.apply.view');
    Route::delete('/job_apply/delete',[ApplicantController::class,'delete_job_apply'])->name('applicant.remove_cv_apply');
    Route::get('list/messages',[MessageController::class,'listMessages'])->name('list.messages');
    Route::get('update/status/messages',[MessageController::class,'updateStatusMessage'])->name('update.status.message');
    Route::get('chatting_View_Applicant',[chattingController::class,'chatting_View_Applicant'])->name('chatting_View_Applicant');
    Route::get('show/view/chatting/by/room_id',[chattingController::class,'show_message_by_room_id'])->name('applicant.show_message.by.room_id');
    Route::post('applicant/send/message',[chattingController::class,'applicant_send_message'])->name('applicant.send_message');
    Route::post('report/post',[ReportPostController::class,'report_post'])->name('report.post');
    Route::post('save/post',[ApplicantController::class,'save_post'])->name('save.post');
    Route::get('save/post/view',[ApplicantController::class,'save_post_view'])->name('save.post.view');
    Route::get('save/post/indexApi',[ApplicantController::class,'save_post_indexApi'])->name('save.post.indexApi');
    Route::delete('/save/post/destroy/{id}',[ApplicantController::class,'save_post_destroy'])->name('save.post.destroy');
});
Route::put('/check/resigntion/hr',[HrController::class,'resigntion'])->name('resignation.hr');
Route::get('/active_account/{token}/{hr_id}',[HrController::class,'active_account'])->name('active_account');
Route::post('/check/login',[loginController::class,'check_login'])->name('check.login');

Route::group([
    'middleware'=>loginHr::class,
],function(){
    Route::get('/index/hr',[HrController::class,'index'])->name('hr.index');
    Route::get('hr/create_post/view',[HrController::class,'create_Post_View'])->name('hr.create_post.view');
    Route::get('hr/create_company/view',[CompaniesController::class,'create_Company_View'])->name('create.company.view');
    Route::put('hr/store_company',[CompaniesController::class,'store'])->name('store.company');
    Route::post('hr/store_post',[PostController::class,'store'])->name('store.post');
    Route::get('hr/edit_post/{id}/{slug}',[PostController::class,'edit_post_view'])->name('post.edit');
    Route::put('hr/update_post/{id}',[PostController::class,'update_post'])->name('update.post');
    Route::get('hr/post_recruitment',[PostController::class,'index'])->name('hr.post_recruitment');
    Route::get('show/posts/view',[HrController::class,'show_posted_view'])->name('show.posted.view');
    Route::delete('hr/delete_post/{id}',[PostController::class,'delete_post'])->name('post.delete');
    Route::get('show/list-applicants/apply/{post_id}/{slug}',[ApplyCvController::class,'show_list_applicants'])->name('show_applicant.apply');
    Route::get('list/messages/hr',[MessageController::class,'listMessagesOfHr'])->name('list.messages.hr');
    Route::get('chatting_View_Hr',[chattingController::class,'chatting_View_Hr'])->name('chatting_View_Hr');
    Route::get('start/contact/with/applicant/{applicant_id}',[roomChatsController::class,'contact_applicant_from_accept_cv_view'])->name('contact_applicant');
    Route::post('hr/send/message',[chattingController::class,'hr_send_message'])->name('hr.send_message');
    Route::post('update/status/chatting',[chattingController::class,'updateStatusTextMessage'])->name('hr.seen.message');
    Route::get('hr/show/view/chatting/by/room_id',[chattingController::class,'hr_show_message_by_room_id'])->name('hr.show_message.by.room_id');
    Route::get('buy/service/view',[ServicesController::class,'buy_service_view'])->name('buy_service_view');
    Route::get('cart/service/view/{service_id}',[ServicesController::class,'cart_service_view'])->name('cart_service_view');
    Route::post('payment/{service_id}',[ServicesController::class,'payment_VNPAY'])->name('payment');
    Route::get('search/cv/applicant',[SubCvController::class,'search_cv_applicant'])->name('search.cv.applicant');
    Route::post('update/used_view',[LevelAccountController::class,'update_used_view'])->name('update_used_view');
    Route::get('email/from/admin',[HrController::class,'email_from_admin'])->name('email.from.admin');
    Route::get('email/from/admin/detail/{id}/{title}',[HrController::class,'email_from_admin_detail'])->name('email.from.admin.detail');
});  



//Route admin
Route::get('/admin/login',function(){
        $builder = new CaptchaBuilder;
        $builder->build();
        $phrase =  $builder->getPhrase();
        session(['phrase'=>$phrase]);
        return view('admin.login_admin_view',[
            'captcha'=>$builder->inline()
        ]);
})->name('login.admin');
Route::get('/admin/logout',function(){
    session()->flush();
    return redirect()->route('login.admin');
})->name('admin.logout');
Route::post('/admin/checkLogin',[adminController::class,'check_login'])->name('admin.checkLogin');
Route::group([
    'middleware'=>loginAdmin::class,
],function(){
    Route::get('/admin/index',[adminController::class,'index_admin_view'])->name('admin.index.view');
    Route::get('/admin/management-post',[adminController::class,'management_post'])->name('management.post');
    Route::get('/admin/post/indexApi',[adminController::class,'post_api'])->name('admin.post.indexApi');
    Route::delete('/admin/post/destroy/{id}',[adminController::class,'destroy'])->name('admin.post.destroy');
    Route::get('/admin/management-company',[adminController::class,'management_company'])->name('management.company');
    Route::get('/admin/company/indexApi',[adminController::class,'company_api'])->name('admin.company.indexApi');
    Route::put('/admin/company/block_up_post/{id}',[adminController::class,'block_up_post'])->name('admin.company.block_up_post');
    Route::get('/admin/management-hr',[adminController::class,'management_hr'])->name('management.hr');
    Route::get('/admin/management-applicant',[adminController::class,'management_applicant'])->name('management.applicant');
    Route::get('/admin/management-hr/indexApi',[adminController::class,'management_hr_indexApi'])->name('admin.management_hr.indexApi');
    Route::put('/admin/management-hr/block_account/{id}',[adminController::class,'block_account'])->name('admin.management_hr.block_account');
    Route::get('/admin/management-applicant/indexApi',[adminController::class,'management_applicant_indexApi'])->name('admin.management_applicant.indexApi');
    Route::put('/admin/management-applicant/block_account/{id}',[adminController::class,'block_account_applicant'])->name('admin.management_applicant.block_account');
    Route::get('/admin/management-services',[adminController::class,'management_services'])->name('management.services');
    Route::get('/admin/services/indexApi',[adminController::class,'management_services_indexApi'])->name('admin.services.indexApi');
    Route::put('/admin/management-services/edit/{id}',[adminController::class,'edit_services'])->name('admin.management_services.edit');
    Route::put('/admin/management-services/delete/{id}',[adminController::class,'delete_services'])->name('admin.management_services.delete');
    Route::get('/admin/management-services/edit/view/{id}',[adminController::class,'edit_services_view'])->name('edit.service.view');
    Route::get('/admin/notify/event',[adminController::class,'notify_event_view'])->name('notify.event');
    Route::get('/admin/notify/event/indexApi',[adminController::class,'email_notify_event_indexApi'])->name('email.notify.event.indexApi');
    Route::get('/admin/notify/event/create/view',[adminController::class,'notify_event_create_view'])->name('notify_event.create.view');
    Route::post('/admin/notify/event/store',[adminController::class,'email_notify_event_store'])->name('email_notify_event.store');
    Route::get('/admin/notify/event/edit/view/{id}',[adminController::class,'notify_event_edit_view'])->name('admin.notify_event.edit');
    Route::put('/admin/notify/event/update/{id}',[adminController::class,'email_notify_event_update'])->name('email_notify_event.update');
    Route::delete('/admin/notify/event/delete/{id}',[adminController::class,'notify_event_delete'])->name('admin.notify_event.delete');
});

Route::get('/post/detail/{id}/{slug}',[PostController::class,'detail'])->name('post.detail');
Route::post('apply_cv/{post_id}/{applicant_id}',[ApplyCvController::class,'apply_cv'])->name('apply.cv');
Route::get('applicant/show/cv_web',[ApplyCvController::class,'show_cv_web'])->name('applicant.show.cv_web');
Route::get('/ajax-paginate-total-jobs-by-city',[HomeController::class,'jobs_by_city'])->name('jobs.by.city');
Route::get('/list-applicants-accepted',[HrController::class,'list_applicants_accepted'])->name('list.applicants.accepted');
Route::get('ajax-get_all_jobs_randoms',[PostController::class,'ajax_paginate_posts_random_detail_page'])->name('ajax.get.all.jobs.randoms');
Route::get('/ajax-paginate-posts-detail_page',[PostController::class,'ajax_paginate_posts_detail_page'])->name('ajax.paginate.detail_page');
Route::get('/search',[PostController::class,'search'])->name('search');

