<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\applicant;
use App\Http\Requests\StoreapplicantRequest;
use App\Http\Requests\UpdateapplicantRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
class ApplicantController extends Controller
{
    public function index(){
        $user = applicant::find(session('id_applicant'));
        return view('applicantview.index',compact('user'));
    }
    public function edit_cv_view(Request $request){
        $cv_user = applicant::find(session::get('id_applicant'));
        return view('applicantview.editCvProfile',compact('cv_user'));
    }
    
    public function update_cv($user_id,Request $request){
        $update_user = applicant::find($user_id);
        $input = $request->all();
        if($request->has('avatar')){
            if($update_user->avatar != null){
                Storage::delete('public/'.$update_user->avatar);
                $avatar = $request->file('avatar')->store('applicant','public');
                $input['avatar'] = $avatar;
                session()->put('update_avatar','update_avatar');
                session()->forget('avatar_newuser');
                session()->put('avatar',$avatar);
            }
            else{
                $avatar = $request->file('avatar')->store('applicant','public');
                $input['avatar'] = $avatar;
                
                session()->put('update_avatar','update_avatar');
                session()->forget('avatar');
                session()->put('avatar',$avatar);
            }
        }
        $update_user->fill($input);
        $update_user->perfection_level = 40;
        $update_user->save();
        return redirect()->route('applicantView');
    }

    public function jobs_apply_view(){
        Carbon::setLocale('vi');
        $jobs_apply = DB::table('apply_cvs')
                    ->join('applicants','apply_cvs.applicant_id','=','applicants.id')
                    ->join('posts','apply_cvs.post_id','=','posts.id')
                    ->join('companies','posts.company_id','=','companies.id')
                    ->select('posts.title as post_title','apply_cvs.status as status_apply','apply_cvs.id as apply_cvs_id','companies.name as company_name','companies.logo as company_logo','apply_cvs.created_at as date_apply','posts.id as post_id','posts.slug as slug')
                    ->orderBy('apply_cvs.created_at','desc')
                    ->where('applicants.id',session('id_applicant'))
                    ->groupBy('applicants.id','posts.title','apply_cvs.status','apply_cvs.id','apply_cvs.created_at','posts.id','companies.name','companies.logo','posts.slug')
                    ->paginate(10);
        return view('applicantview.jobs_Apply',compact('jobs_apply'));
    }
    public function delete_job_apply(request $request)
    {
        $delete_job_apply = DB::table('apply_cvs')->where('id',$request->job_apply_cv_id)->delete();
        return response()->json(['message'=>'Xóa thành công']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreapplicantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $new_applicant = new applicant();
        $new_applicant->fill($data);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(applicant $applicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateapplicantRequest  $request
     * @param  \App\Models\applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateapplicantRequest $request, applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(applicant $applicant)
    {
        //
    }
}
