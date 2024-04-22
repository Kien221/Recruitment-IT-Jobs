<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LevelAccount;
use App\Models\watch_cv;

class LevelAccountController extends Controller
{
    public function update_used_view(Request $request){
        $level_account_hr = LevelAccount::join('hrs','level_account.hr_id','=','hrs.id')
        ->join('services','level_account.service_id','=','services.id')
        ->where('level_account.hr_id', session('id_hr'))
        ->select('level_account.*','services.*')
        ->first();;
        if($level_account_hr->used_views < $level_account_hr->view_every_day){
            $account_hr = LevelAccount::where('hr_id',session('id_hr'))->first();
            $account_hr->used_views = $account_hr->used_views + 1;
            $account_hr->save();
            $watch_cv = watch_cv::where('hr_id',session('id_hr'))->where('applicant_id',$request->applicant_id)->first();
            if($watch_cv == null){
                $watch_cv = new watch_cv();
                $watch_cv->hr_id = session('id_hr');
                $watch_cv->applicant_id = $request->applicant_id;
                $watch_cv->save();
            }
            return response()->json(['data'=>'success']);
        }
        else{
            return response()->json(['data'=>'Bạn đã hết lượt xem hồ sơ ứng viên hôm nay, vui lòng quay lại vào hôm sau']);
        }
        
    }
}
