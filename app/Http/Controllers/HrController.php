<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\hr;
use Mail;
use Illuminate\Support\Str;
use App\Http\Requests\StorehrRequest;
use App\Http\Requests\UpdatehrRequest;

class HrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function resigntion(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        $input = $request->all();
        $check_email = hr::where('email',$input['email'])->first();
        if($check_email){
            return redirect()->route('signup.hr')->with('email_exited','Email đã tồn tại');
        }
        else{
            $hr = new hr();
            $token = str::random(10);
            $input['token'] = $token;
            $hr->fill($input);
            $hr->save();
            if($hr->save()){
                Mail::send('emails.active_account',compact('hr'),function($email) use($hr){
                    $email->subject('TopCV - Xác nhận tài khoản');
                    $email->to($hr->email,$hr->name);
                });
                return redirect()->route('login')->with('success','Đăng ký thành công, Vui lòng kiểm tra email để xác nhận tài khoản');
            }
            else{
                return redirect()->route('login');
            }
        }
  
    }
    public function active_account($token,$hr_id){
        $hr = hr::where('token',$token)->first();
        if($hr){
            $hr->status = 1;
            $hr->save();
            return redirect()->route('login')->with('active_account_success','Kích hoạt tài khoản thành công');
        }
        else{
            return redirect()->route('login')->with('error','Kích hoạt tài khoản thất bại');
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorehrRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorehrRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hr  $hr
     * @return \Illuminate\Http\Response
     */
    public function show(hr $hr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hr  $hr
     * @return \Illuminate\Http\Response
     */
    public function edit(hr $hr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatehrRequest  $request
     * @param  \App\Models\hr  $hr
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatehrRequest $request, hr $hr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hr  $hr
     * @return \Illuminate\Http\Response
     */
    public function destroy(hr $hr)
    {
        //
    }
}
