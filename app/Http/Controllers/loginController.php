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
        $applicant = applicant::where('email',$email)->where('password',$password)->first();
        $hr = hr::where('email',$email)->where('password',$password)->first();
        if($applicant){
            session()->put('success_login_applicant','success_login_applicant');
            session()->put('id_aplicant',$check_login_applicant->id);
            session()->put('applicant_name',$check_login_applicant->name);
            session()->put('avatar',$check_login_applicant->avatar);
            return redirect()->route('home');
        }
        else if($hr){
            if($hr->status == 1){
                session()->put('success_login_hr','success_login_hr');
                session()->put('id_hr',$hr->id);
                session()->put('hr_name',$hr->name);
                session()->put('avatar',$hr->avatar);
                return redirect()->route('hr.index');
            }
            else{
                return redirect()->route('login')->with('error_active_account','Tài khoản chưa được kích hoạt');
            }
        }
        else{
            session()->put('error_login','error_login');
            return redirect()->route('login');
        }
    }
}
