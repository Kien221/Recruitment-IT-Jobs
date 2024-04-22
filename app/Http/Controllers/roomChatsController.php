<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class roomChatsController extends Controller
{
    public function contact_applicant_from_accept_cv_view(request $request){
        $applicant_id = $request->applicant_id;
        $id_hr = session('id_hr');
        $rooms_chat = DB::table('rooms_chat')
                    ->join('hrs','rooms_chat.hr_id','=','hrs.id')
                    ->join('applicants','rooms_chat.applicant_id','=','applicants.id')
                    ->where('hrs.id',$id_hr)
                    ->select('applicants.id as applicant_id','applicants.name as applicant_name','applicants.avatar as applicant_avatar','rooms_chat.id as room_id')
                    ->get();
        $rooms_chat_of_hr = DB::table('rooms_chat')
                    ->where('hr_id', session('id_hr'))
                    ->join('applicants', 'rooms_chat.applicant_id', '=', 'applicants.id')
                    ->leftJoin('chatting', function ($join) {
                        $join->on('rooms_chat.id', '=', 'chatting.room_id')
                            ->whereRaw('chatting.id IN (SELECT MAX(id) FROM chatting GROUP BY room_id)');
                    })
                    ->select('chatting.id','applicants.name as applicant_name','applicants.avatar as applicant_avatar','chatting.text_message as last_message', 'chatting.created_at as last_message_time', 'rooms_chat.id as room_id','chatting.from as from','chatting.status as status')
                    ->get(); 
        $check_room = DB::table('rooms_chat')
                        ->where('hr_id',$id_hr)
                        ->where('applicant_id',$applicant_id)
                        ->first();
        $text_message = DB::table('chatting')
                        ->join('rooms_chat','chatting.room_id','=','rooms_chat.id')
                        ->join('hrs','rooms_chat.hr_id','=','hrs.id')
                        ->join('companies','hrs.id','=','companies.hr_id')
                        ->join('applicants','rooms_chat.applicant_id','=','applicants.id')
                        ->where('hrs.id',$id_hr)
                        ->where('applicants.id',$applicant_id)
                        ->select('chatting.text_message as text_message','chatting.from as from','chatting.created_at as created_at','applicants.avatar as applicant_avatar','companies.logo as company_logo')
                        ->get();
        $applicant = DB::table('applicants')
                        ->where('id',$applicant_id)
                        ->first();
                 
        if($check_room){
            $room_id = $check_room->id;
            return view('hr_view.chattingHrViewFromAcceptCv',compact('room_id','rooms_chat','rooms_chat_of_hr','text_message','applicant'));
        }
        else{
            $room_id = DB::table('rooms_chat')->insertGetId([
                'hr_id' => $id_hr,
                'applicant_id' => $applicant_id
            ]);
            return view('hr_view.chattingHrViewFromAcceptCv',compact('room_id','applicant','rooms_chat','rooms_chat_of_hr','text_message'));
        }
    }
}
