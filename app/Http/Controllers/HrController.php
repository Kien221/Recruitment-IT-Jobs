<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\hr;
use App\Models\Post;
use App\Models\companies;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Requests\StorehrRequest;
use App\Http\Requests\UpdatehrRequest;
use App\Models\apply_cv;

class HrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hr = hr::find(session()->get('id_hr'));
        return View('hr_view.index',compact('hr'));
    }

    public function resigntion(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return redirect()->route('signup.hr')->with('fails_password','Mật khẩu không khớp');
        }
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

    public function create_Post_View(){
        $hr = hr::find(session()->get('id_hr'));
        $company = companies::where('hr_id',$hr->id)->first();
        if($company){
            return view('hr_view.create_post',compact('company'));
        }
        else{
            return redirect()->route('create.company.view')->with('error','Vui lòng tạo công ty trước khi đăng tin tuyển dụng');
        }  
    }
    public function show_posted_view()
    {
        $hr = hr::find(session()->get('id_hr'));
        $posted = Post::query()
        ->join('companies','companies.id','=','posts.company_id')
        ->where('companies.hr_id',$hr->id)
        ->select('posts.*')
        ->orderBy('posts.created_at','asc')
        ->paginate(10);
        foreach($posted as $post){
            $post->created_at = Carbon::parse($post->created_at)->format('d-m-Y');
            $post->expired_post = Carbon::parse($post->expired_post)->format('d-m-Y');
            $post_expired = strtotime($post->expired_post);
            $now = strtotime(Carbon::now()->format('d-m-Y'));
            $is_expired = $post_expired - $now;
            if($is_expired > 0){
                $post->is_expired = 1;
            }
            else{
                $post->is_expired = 0;
            }
            $applicant = apply_cv::where('post_id',$post->id)->count(); 
            $post->applicant = $applicant;
        }
        return view('hr_view.show_posted',compact('posted'));

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
