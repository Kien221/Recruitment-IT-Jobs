<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCv;
use Illuminate\Support\Facades\DB;
use App\Models\LevelAccount;
class SubCvController extends Controller
{
    public function update_sub_cv(Request $request){
        $sub_cv = SubCV::where('applicant_id',session('id_applicant'))->first();
        if($sub_cv == null){
            $new_sub_cv = new SubCV();
            $new_sub_cv->create([
                'applicant_id' => session('id_applicant'),
                'typeCV' => $request->typeCV,
                'exp_year_work' => $request->exp_year_work,
                'position_want_to_apply' => $request->position_want_to_apply,
                'languages_want_to_apply' => $request->languages_want_to_apply,
                'city_want_to_work' => $request->city_want_to_work
            ]);
        }
        else{
            $sub_cv->update([
                'typeCV' => $request->typeCV,
                'exp_year_work' => $request->exp_year_work,
                'position_want_to_apply' => $request->position_want_to_apply,
                'languages_want_to_apply' => $request->languages_want_to_apply,
                'city_want_to_work' => $request->city_want_to_work
            ]);
        }
        return redirect()->route('applicant.index.view');
    }
    public function search_cv_applicant(Request $request){
        $level_account_hr = LevelAccount::join('hrs','level_account.hr_id','=','hrs.id')
                            ->join('services','level_account.service_id','=','services.id')
                            ->where('level_account.hr_id', session('id_hr'))
                            ->select('level_account.*','services.*')
                            ->first();;
        if($level_account_hr->used_search < $level_account_hr->search_every_day){
            $account_hr = LevelAccount::where('hr_id',session('id_hr'))->first();
            $account_hr->used_search = $account_hr->used_search + 1;
            $account_hr->save();
            $list_cv =  DB::table('sub_cv')
            ->join('applicants','sub_cv.applicant_id','=','applicants.id')
            ->where('position_want_to_apply','like','%'.$request->search_by_position_want_to_open.'%')
            ->where('exp_year_work','like','%'.$request->search_by_exp_year_work.'%')
            ->where('languages_want_to_apply','like','%'.$request->search_by_languages_want_to_open.'%')
            ->where('city_want_to_work','like','%'.$request->search_by_city.'%')
            ->where('applicants.status_public_cv',1)
            ->select('applicants.avatar as applicant_avatar','applicants.name as applicant_name','applicants.email as applicant_email','sub_cv.typeCV as typeCV','sub_cv.position_want_to_apply as position_want_to_apply','sub_cv.exp_year_work as exp_year_work','sub_cv.languages_want_to_apply as languages_want_to_apply','sub_cv.city_want_to_work as city_want_to_work','applicants.filecv as filecv','applicants.id as id_applicant')
            ->get();
            $html = view('layout.api.search_cv_applicant',compact('list_cv','account_hr','level_account_hr'))->render();
            $count_row = count($list_cv);
            return response()->json(['data'=>$html,
                                    'count_row'=>$count_row,
                                    'used_search'=>$account_hr->used_search,
                                   ]);
        }
        else{
            return response()->json(['data'=>'Bạn đã hết lượt tìm kiếm hồ sơ ứng viên hôm nay, vui lòng quay lại vào hôm sau']);
        }
    }
}
