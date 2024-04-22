<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\report_post;
use App\Models\Post;

class ReportPostController extends Controller
{
    public function report_post(Request $request){
        $find_person_report = report_post::where('applicant_report_id',$request->person_report)->where('post_id',$request->post_id)->first();
        if($find_person_report){
            return response()->json(['data'=>'Bạn đã report bài đăng này rồi']);
        }   
        else{
            $report = new report_post();
            $report->applicant_report_id = $request->person_report;
            $report->post_id = $request->post_id;
            $report->reason = $request->reason;
            $report->save();
            $post = Post::where('id',$request->post_id)->first();
            $post->update([
                'num_report' => $post->num_report + 1,
            ]);
            $hr = $post->company->hr;
            // + 1 faul for num_faul column of hr table
            $hr->update([
                'num_faul' => $hr->num_faul + 1,
            ]);
            return response()->json(['data'=>'Bạn đã report bài đăng này thành công']);
        }
    }
}
