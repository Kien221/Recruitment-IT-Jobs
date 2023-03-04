<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\apply_cv;
use App\Models\Post;
use App\Http\Requests\Storeapply_cvRequest;
use App\Http\Requests\Updateapply_cvRequest;
use Redirect;
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
            return Redirect::back()->with('apply_cv_success', 'Nộp cv thành công , vui lòng chờ phản hồi từ nhà tuyển dụng');
        }
        
    }
    public function show_list_applicants(Request $request,$post_id){
        $list_applicants = apply_cv::query()
                            ->join('applicants','applicants.id','=','apply_cvs.applicant_id')
                            ->where('apply_cvs.post_id',$post_id)
                            ->select('applicants.*','apply_cvs.*')
                            ->orderBy('apply_cvs.created_at','desc')
                            ->paginate(10);
        $post = Post::find($post_id);
        return view('hr_view.list_applicants_apply',compact('list_applicants','post'));
    }

    public function show_cv_web(Request $request){
        $applicant_cv = apply_cv::query()
                    ->join('applicants','applicants.id','=','apply_cvs.applicant_id')
                    ->where('apply_cvs.id',$request->applicant_id)
                    ->select('applicants.*','apply_cvs.*')
                    ->first();
        $data_html = view('layout.applicantview.cv_applicant',compact('applicant_cv'))->render();
        return response()->json($data_html);

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
