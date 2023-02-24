<?php
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Models\Applicant;
use App\Http\Middleware\loginApplicant;

Route::get('/home',[HomeController::class,'index'])->name('home');
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
})->name('auth.github');
 
Route::get('/auth/callback/{provider}', function ($provider) {
    $user = Socialite::driver($provider)->user();
    $query = Applicant::where('id',$user->getId())->first();
    if($query){
        $call_user = Applicant::where('id',$query->id)->first();
        session()->put('success_login_applicant','success_login_applicant');
        session()->put('id_applicant',$call_user->id);
        session()->put('applicant_name',$call_user->name);
        session()->put('avatar',$call_user->avatar);
        if(session('post_id') != null){
            return redirect()->route('post.detail',[session('post_id'),session('slug')]);
            session()->forget('post_id');
            session()->forget('slug');
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
    Route::put('/update/infor/applicant/{user_id}.html',[ApplicantController::class,'update_infor'])->name('update.infor.applicant');
    Route::put('/update/introdeyourself/applicant/{user_id}.html',[ApplicantController::class,'update_introdeyourself'])->name('update.introdeyourself');
    Route::put('/update/degree/applicant/{user_id}.html',[ApplicantController::class,'update_degree'])->name('update.degree');
    Route::put('/update/exp/applicant/{user_id}.html',[ApplicantController::class,'update_exp'])->name('update.exp');
    Route::put('/update/languague-skill/applicant/{user_id}.html',[ApplicantController::class,'update_languae_skill'])->name('update.language.skill');
    Route::get('/applicant/view/{user_id}.html',[ApplicantController::class,'index'])->name('applicant.index.view');
});
Route::put('/check/resigntion/hr',[HrController::class,'resigntion'])->name('resignation.hr');
Route::get('/active_account/{token}/{hr_id}',[HrController::class,'active_account'])->name('active_account');
Route::post('/check/login',[loginController::class,'check_login'])->name('check.login');
Route::get('/index/hr',[HrController::class,'index'])->name('hr.index');
Route::get('hr/create_post/view',[HrController::class,'create_Post_View'])->name('hr.create_post.view');
Route::get('hr/create_company/view',[CompaniesController::class,'create_Company_View'])->name('create.company.view');
Route::put('hr/store_company',[CompaniesController::class,'store'])->name('store.company');
Route::post('hr/store_post',[PostController::class,'store'])->name('store.post');
Route::get('hr/post_recruitment',[PostController::class,'index'])->name('hr.post_recruitment');


Route::get('/post/detail/{id}/{slug}',[PostController::class,'detail'])->name('post.detail');

