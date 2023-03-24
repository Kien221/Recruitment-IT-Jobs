<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function listMessages(Request $request){
        Carbon::setLocale('vi');
        $id = $request->id_applicant;
        $list_message = DB::table('messages')
                        ->join('apply_cvs','messages.apply_cvs_id','=','apply_cvs.id')
                        ->join('posts','apply_cvs.post_id','=','posts.id')
                        ->join('companies','posts.company_id','=','companies.id')
                        ->join('applicants','applicants.id','=','apply_cvs.applicant_id')
                        ->where('applicants.id',$id)
                        ->select('messages.message as message','messages.created_at as created_at',
                        'messages.status as status','messages.id as message_id',
                        'companies.logo as company_logo')
                        ->orderBy('messages.created_at','desc')
                        ->get();
        $html =  view('layout.api.list_messages',compact('list_message'))->render();
        return response()->json($html);
    }
    public function updateStatusMessage(request $request){
        $id = $request->id_message;
        $update_status = DB::table('messages')
                        ->where('id',$id)
                        ->update(['status' => 1]);
        $apply_cv_id = DB::table('messages')
                        ->join('apply_cvs','messages.apply_cvs_id','=','apply_cvs.id')
                        ->where('messages.id',$id)
                        ->select('apply_cvs.id as apply_cvs_id')
                        ->first();
        session()->put('apply_cv_id',$apply_cv_id->apply_cvs_id);
        return response()->json($apply_cv_id);
    }
}
