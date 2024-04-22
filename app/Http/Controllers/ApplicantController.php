<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\applicant;
use App\Models\messages;
use App\Models\apply_cv;
use App\Http\Requests\StoreapplicantRequest;
use App\Http\Requests\UpdateapplicantRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
class ApplicantController extends Controller
{
    public function index(){
        $user = applicant::find(session('id_applicant'));
        $sub_cv = DB::table('sub_cv')->where('applicant_id',session('id_applicant'))->first();
        $company_watch_cv = DB::table('watch_cv')
                            ->join('applicants','watch_cv.applicant_id','=','applicants.id')
                            ->join('hrs','watch_cv.hr_id','=','hrs.id')
                            ->join('companies','hrs.id','=','companies.hr_id')
                            ->select('companies.name as company_name','companies.logo as company_logo','watch_cv.created_at as date_watch')
                            ->where('watch_cv.applicant_id',session('id_applicant'))
                            ->groupBy('companies.name','companies.logo','watch_cv.created_at')
                            ->orderBy('watch_cv.created_at','desc')
                            ->get();
        return view('applicantview.index',compact('user','sub_cv','company_watch_cv'));
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
        if($request->file_cv != null){
            $name_file_cv = $request->file('file_cv')->store('fileCv','public');
            $update_user->filecv = $name_file_cv;
        }
        $update_user->fill($input);
        $update_user->perfection_level = 40;
        $update_user->save();
        return redirect()->route('applicantView');
    }

    public function update_status_public_cv(Request $request){
        $update_status = applicant::find(session('id_applicant'));
        $update_status->update([
            'status_public_cv' => $request->status_public_cv
        ]);
        return response()->json(['message'=>'Cập nhật thành công']);
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
        $message_id = messages::where('apply_cvs_id',$request->job_apply_cv_id)->first();
        if($message_id != null){
            DB::table('messages')->where('id',$message_id->id)->delete();
        }
        $apply_cv_id = apply_cv::find($request->job_apply_cv_id);
        if($apply_cv_id->file_cv != null){
            Storage::delete('public/'.$apply_cv_id->file_cv);
            DB::table('apply_cvs')->where('id',$request->job_apply_cv_id)->delete();
        }
        DB::table('apply_cvs')->where('id',$request->job_apply_cv_id)->delete();
        return response()->json(['message'=>'Xóa thành công']);
    }

    public function save_post(Request $request){
        $check_save = DB::table('save_post')->where('applicant_id',session('id_applicant'))->where('post_id',$request->post_id)->first();
        if($check_save == null){
            DB::table('save_post')->insert([
                'applicant_id' => session('id_applicant'),
                'post_id' => $request->post_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            return response()->json(['save_post_success'=>'Lưu bài viết thành công']);
        }
        else{
            return response()->json(['save_post_fail'=>'Bạn đã lưu bài viết này rồi']);
        }

    }
    public function save_post_view(){
        return view('applicantview.save_post');
    }    public function save_post_indexApi(){
        $save_post = DB::table('save_post')
                    ->join('posts','save_post.post_id','=','posts.id')
                    ->join('companies','posts.company_id','=','companies.id')
                    ->select('posts.title as post_title','posts.id as post_id','companies.name as company_name','companies.logo as company_logo','posts.slug as slug','save_post.created_at as created_at')
                    ->where('save_post.applicant_id',session('id_applicant'))
                    ->orderBy('save_post.created_at','desc')
                    ->get();            
                    return DataTables::of($save_post)
                    ->editColumn('company', function ($save_post) {
                        return '<img src="'.asset('storage/'.$save_post->company_logo).'" width="100px" height="100px">
                        '.$save_post->company_name;
                    })
                    ->editColumn('id',function($save_post){
                        return 1;
                    })
                    ->editColumn('title', function($save_post) {
                        $title = '<a href="'.route('post.detail', [$save_post->post_id, $save_post->slug]).'">'.$save_post->post_title.'</a>';
                        return $title;
                    })
                    ->editColumn('time_saved',function($save_post){
                        return Carbon::parse($save_post->created_at)->locale('vi')->diffForHumans();
                    })
                    ->addColumn('delete',function($save_post){
                        return route('save.post.destroy',$save_post->post_id);
                    })
                    ->rawColumns(['company','title','delete'])
                    ->make(true);
    }
    public function save_post_destroy($id){
        DB::table('save_post')->where('post_id',$id)->where('applicant_id',session('id_applicant'))->delete();
        return redirect()->route('save.post.view');
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
