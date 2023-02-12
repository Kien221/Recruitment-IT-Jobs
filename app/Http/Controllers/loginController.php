<?php

namespace App\Http\Controllers;
use App\Models\hr;
use App\Models\applicant;
use Illuminate\Http\Request;

class loginController extends Controller
{
    public function check_login(Request $request){
        $email = $request->email;
        $password = $request->password;
        $check_login_applicant = applicant::where('email',$email)->where('password',$password)->first();
        $check_login_hr = hr::where('email',$email)->where('password',$password)->first();
        if($check_login_applicant){
            session()->put('success_login','success_login');
            session()->put('id_aplicant',$check_login_applicant->id);
            session()->put('applicant_name',$check_login_applicant->name);
            session()->put('avatar',$check_login_applicant->avatar);
            return redirect()->route('home');
        }
        else if($check_login_hr){
            if($check_login_hr->status == 1){
                session()->put('success_login','success_login');
                session()->put('id_hr',$check_login_hr->id);
                session()->put('hr_name',$check_login_hr->name);
                session()->put('avatar',$check_login_hr->avatar);
                return View('hr_view.index');
            }
            else{
                return redirect()->route('login')->with('error_login','Tài khoản chưa được kích hoạt');
            }
        }
        else{
            session()->put('error_login','error_login');
            return redirect()->route('login');
        }
    }
}
