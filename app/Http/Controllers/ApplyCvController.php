<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\apply_cv;
use App\Models\Post;
use App\Models\messages;
use App\Events\HrAcceptCv;
use App\Events\AppliCantSendCv;
use App\Http\Requests\Storeapply_cvRequest;
use App\Http\Requests\Updateapply_cvRequest;
use Illuminate\Support\Facades\DB;
use Redirect;
use App\Models\LevelAccount;
use App\Models\watch_cv;

class ApplyCvController extends Controller
{

    public function index()
    {
        //
    }
    public function apply_cv(Request $request,$post_id,$applicant_id){
        $check_apply = apply_cv::where('post_id',$post_id)->where('applicant_id',$applicant_id)->first();
        if($check_apply){
            return Redirect::back()->with('apply_cv_error', 'Bạn đã nộp cv cho bài viết này rồi');
        }
        else{
            $apply_cv = new apply_cv();
            $apply_cv->post_id = $post_id;
            $apply_cv->applicant_id = $applicant_id;
            $hr_id = Post::find($post_id)->company->hr->id;
            
            if($request->type_cv === 'cv_web'){
                $apply_cv->type_cv = 'cv_web';
                $apply_cv->file_cv = ""; 
            }
            else{
                $apply_cv->type_cv = 'cv_upload';
                if($request->file_cv != null){
                    $name_file_cv = $request->file('file_cv')->store('fileCv','public');
                    $apply_cv->file_cv = $name_file_cv;
                }
    
            }
            $apply_cv->brief_introduce = $request->brief_introduce;
            $apply_cv->save();
            $message = "Bạn có 1 cv mới từ ".$apply_cv->applicant->name;
            $send_to = "hr";
            event(new AppliCantSendCv($message,$hr_id));
            messages::create([
                'apply_cvs_id' => $apply_cv->id,
                'message' => $message,
                'send_to'    => $send_to
            ]);
            return Redirect::back()->with('apply_cv_success', 'Nộp cv thành công , vui lòng chờ phản hồi từ nhà tuyển dụng');
        }
        
    }
    public function show_list_applicants(Request $request,$post_id){
        $list_applicants = apply_cv::query()
                            ->join('applicants','applicants.id','=','apply_cvs.applicant_id')
                            ->join('posts','posts.id','=','apply_cvs.post_id')
                            ->where('apply_cvs.post_id',$post_id)
                            ->select('applicants.*','apply_cvs.brief_introduce as brief_introduce','apply_cvs.file_cv as file_cv','apply_cvs.status as status','apply_cvs.type_cv as type_cv')
                            ->orderBy('apply_cvs.created_at','desc')
                            ->paginate(10);
        $post = Post::find($post_id);
        return view('hr_view.list_applicants_apply',compact('list_applicants','post'));
    }

    public function show_cv_web(Request $request){
        $level_account_hr = LevelAccount::join('hrs','level_account.hr_id','=','hrs.id')
        ->join('services','level_account.service_id','=','services.id')
        ->where('level_account.hr_id', session('id_hr'))
        ->select('level_account.*','services.*')
        ->first();;
        if($level_account_hr->used_views < $level_account_hr->view_every_day){
            $account_hr = LevelAccount::where('hr_id',session('id_hr'))->first();
            $account_hr->used_views = $account_hr->used_views + 1;
            $account_hr->save();
            $applicant_cv = apply_cv::query()
                        ->join('applicants','applicants.id','=','apply_cvs.applicant_id')
                        ->where('apply_cvs.applicant_id',$request->applicant_id)
                        ->select('applicants.*','apply_cvs.*')
                        ->first();
            $watch_cv = watch_cv::where('hr_id',session('id_hr'))->where('applicant_id',$request->applicant_id)->first();
            if($watch_cv == null){
                $watch_cv = new watch_cv();
                $watch_cv->hr_id = session('id_hr');
                $watch_cv->applicant_id = $request->applicant_id;
                $watch_cv->save();
            }
            $data_html = view('layout.applicantview.cv_applicant',compact('applicant_cv'))->render();
             return response()->json($data_html);
        }
        else{
            return response()->json(['Bạn đã hết lượt xem hồ sơ ứng viên hôm nay, vui lòng quay lại vào hôm sau']);
        }
    }
    public function acceptCv(Request $request){
        $update_status_apply_cv = apply_cv::where('post_id',$request->post_id)->where('applicant_id',$request->applicant_id)->first();    
        if($update_status_apply_cv){
            $update_status_apply_cv->status = 1;
            $update_status_apply_cv->save();
            $message = "CV bạn đã được chấp nhận ".$update_status_apply_cv->post->company->name. " sẽ sớm liên hệ đến bạn";
            event(new HrAcceptCv($message,$request->applicant_id));
            messages::create([
                'apply_cvs_id' => $update_status_apply_cv->id,
                'message' => $message,
                'send_to'      => 'applicant'
            ]);
            return response()->json(['success'=>'Duyệt Cv thành công']);
        }
        else{
            return response()->with("accept_cv_error",'Có lỗi xảy ra , vui lòng thử lại sau!!');
        }
            
    }
    public function refuseCv(Request $request){
        $update_status_apply_cv = apply_cv::where('post_id',$request->post_id)->where('applicant_id',$request->applicant_id)->first();    
        if($update_status_apply_cv){
            $update_status_apply_cv->status = 2;
            $update_status_apply_cv->save();
            return response()->json(['success'=>'Từ chối Cv thành công']);
        }
        else{
            return response()->with("accept_cv_error",'Có lỗi xảy ra , vui lòng thử lại sau!!');
        }
            
    }
    public function count_messages(Request $request){
        if($request->from_to == 'hr'){
            $id = $request->hr_id;
            $count_message = DB::table('messages')
            ->join('apply_cvs','messages.apply_cvs_id','=','apply_cvs.id')
            ->join('posts','posts.id','=','apply_cvs.post_id')
            ->join('companies','companies.id','=','posts.company_id')
            ->join('hrs','hrs.id','=','companies.hr_id')
            ->where('hrs.id',$id)
            ->where('messages.send_to','hr')
            ->where('messages.status',0)
            ->count();
            return response()->json([
                'count_message' => $count_message,
            ]);
        }
        if($request->from_to == 'applicant'){
            $id = $request->id_applicant;
            $count_message = DB::table('messages')
            ->join('apply_cvs','messages.apply_cvs_id','=','apply_cvs.id')
            ->join('applicants','applicants.id','=','apply_cvs.applicant_id')
            ->where('applicants.id',$id)
            ->where('messages.send_to','applicant')
            ->where('messages.status',0)
            ->count();
            return response()->json([
                'count_message' => $count_message,
            ]);
        }
    }
    
    public function store(Storeapply_cvRequest $request)
    {
        //
    }

    public function show(apply_cv $apply_cv)
    {
        //
    }
    public function edit(apply_cv $apply_cv)
    {
        //
    }

    public function update(Updateapply_cvRequest $request, apply_cv $apply_cv)
    {
        //
    }

    public function destroy(apply_cv $apply_cv)
    {
        //
    }
}
