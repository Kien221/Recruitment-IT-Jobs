<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Events\ChattingFromHrEvent;
use App\Events\ChattingFromApplicantEvent;
use App\Events\UserReceivedChattingMessage;
use App\Models\chatting;
use App\Models\roomChats;

class chattingController extends Controller
{
    public function chatting_View_Applicant(Request $request){

        // select tất cả các room chat có applicant_id = session('id_applicant') và mỗi room chat lấy ra 1 tin nhắn cuối cùng
        $rooms_chat_of_applicant = DB::table('rooms_chat')
                                ->where('applicant_id', session('id_applicant'))
                                ->join('hrs', 'rooms_chat.hr_id', '=', 'hrs.id')
                                ->join('companies', 'hrs.id', '=', 'companies.hr_id')
                                ->leftJoin('chatting', function ($join) {
                                    $join->on('rooms_chat.id', '=', 'chatting.room_id')
                                        ->whereRaw('chatting.id IN (SELECT MAX(id) FROM chatting GROUP BY room_id)');
                                })
                                ->select('companies.name as company_name', 'chatting.text_message as last_message', 'chatting.created_at as last_message_time', 'companies.logo as company_logo', 'rooms_chat.id as room_id','chatting.from as from','chatting.status as status')
                                ->get(); 
   
        return view('applicantview.chattingApplicantView',compact('rooms_chat_of_applicant'));
    }

    public function list_roomchat(request $request){
        if($request->from_to == 1){
            $rooms_chat_of_hr = DB::table('rooms_chat')
            ->where('hr_id', $request->hr_id)
            ->join('applicants', 'rooms_chat.applicant_id', '=', 'applicants.id')
            ->leftJoin('chatting', function ($join) {
                $join->on('rooms_chat.id', '=', 'chatting.room_id')
                    ->whereRaw('chatting.id IN (SELECT MAX(id) FROM chatting GROUP BY room_id)');
            })
            ->select('applicants.name as applicant_name','applicants.avatar as applicant_avatar','chatting.text_message as last_message', 'chatting.created_at as last_message_time', 'rooms_chat.id as room_id','chatting.from as from','chatting.status as status')
            ->get(); 
            $data_html = view('layout.hrview.list_roomchat_of_hr',compact('rooms_chat_of_hr'))->render();
        }
        if($request->from_to == 0){
            $rooms_chat_of_applicant = DB::table('rooms_chat')
            ->where('applicant_id', $request->applicant_id)
            ->join('hrs', 'rooms_chat.hr_id', '=', 'hrs.id')
            ->join('companies', 'hrs.id', '=', 'companies.hr_id')
            ->leftJoin('chatting', function ($join) {
                $join->on('rooms_chat.id', '=', 'chatting.room_id')
                    ->whereRaw('chatting.id IN (SELECT MAX(id) FROM chatting GROUP BY room_id)');
            })
            ->select('companies.name as company_name', 'chatting.text_message as last_message', 'chatting.created_at as last_message_time', 'companies.logo as company_logo', 'rooms_chat.id as room_id','chatting.from as from','chatting.status as status')
            ->get(); 
            $data_html = view('layout.applicantview.list_roomchat_of_applicant',compact('rooms_chat_of_applicant'))->render();
        }
        return response()->json($data_html);

    }
    public function chatting_View_Hr(Request $request){
        if(session('id_hr') == null){
            return redirect()->route('login');
        }
        else{
            $id_hr = session('id_hr');
            $rooms_chat_of_hr = DB::table('rooms_chat')
            ->where('hr_id', $id_hr)
            ->join('applicants', 'rooms_chat.applicant_id', '=', 'applicants.id')
            ->leftJoin('chatting', function ($join) {
                $join->on('rooms_chat.id', '=', 'chatting.room_id')
                    ->whereRaw('chatting.id IN (SELECT MAX(id) FROM chatting GROUP BY room_id)');
            })
            ->select('applicants.name as applicant_name','applicants.avatar as applicant_avatar','chatting.text_message as last_message', 'chatting.created_at as last_message_time', 'rooms_chat.id as room_id','chatting.from as from','chatting.status as status')
            ->get(); 
        return view('hr_view.chattingHrView',compact('rooms_chat_of_hr'));
        }
    }
    public function hr_send_message(Request $request){
        $text_message = $request->text_message;
        $applicant_id = $request->applicant_id;
        $from = $request->from;
        $company_info = DB::table('companies')
                        ->join('hrs','hrs.id','=','companies.hr_id')
                        ->where('hrs.id',session('id_hr'))
                        ->select('companies.name as company_name','companies.logo as company_logo')
                        ->first();
        if($request->room_id == null){
            $room_chat = new roomChats();
            $room_chat->hr_id = session('id_hr');
            $room_chat->applicant_id = $applicant_id;
            $room_chat->save();
            $chatting = new chatting();
            $chatting->room_id = $room_chat->id;
            $chatting->text_message = $text_message;
            $chatting->from = $from;
            $chatting->save();
            event(new ChattingFromHrEvent($text_message,$room_chat->id,$applicant_id,$from));
            event(new UserReceivedChattingMessage($applicant_id));
        }
        else{
            $room_id = $request->room_id;
            $chatting = new chatting();
            $chatting->room_id = $request->room_id;
            $chatting->text_message = $text_message;
            $chatting->from = $from;
            $chatting->save();
            event(new ChattingFromHrEvent($text_message,$room_id,$applicant_id,$from));
            event(new UserReceivedChattingMessage($applicant_id));
        }
        return response()->json([
            'text_message'=>$text_message,
            'company_info'=>$company_info,
        ]);
    }
    public function applicant_send_message(Request $request){
        $text_message = $request->text_message;
        $hr_id = $request->hr_id;
        $from = $request->from;
        $room_id = $request->room_id;
        event(new ChattingFromApplicantEvent($text_message,$room_id,$hr_id,$from));
        event(new UserReceivedChattingMessage($hr_id));
        $chatting = new chatting();
        $chatting->room_id = $request->room_id;
        $chatting->text_message = $text_message;
        $chatting->from = $from;
        $chatting->save();
        return response()->json($request->all());
    }

    

    public function show_message_by_room_id (Request $request){
        $company_info = DB::table('rooms_chat')
                        ->join('hrs','rooms_chat.hr_id','=','hrs.id')
                        ->join('companies','hrs.id','=','companies.hr_id')
                        ->where('rooms_chat.id',$request->room_id)
                        ->select('companies.name as company_name','companies.logo as company_logo')
                        ->first(); 
        $text_message = DB::table('chatting')
                    ->join('rooms_chat','chatting.room_id','=','rooms_chat.id')
                    ->join('hrs','rooms_chat.hr_id','=','hrs.id')
                    ->join('applicants','rooms_chat.applicant_id','=','applicants.id')
                    ->where('rooms_chat.id',$request->room_id)
                    ->select('chatting.text_message as text_message','chatting.from as from','chatting.created_at as created_at','applicants.id as applicant_id','applicants.name as applicant_name','applicants.avatar as applicant_avatar','hrs.id as hr_id','hrs.name as hr_name','hrs.avatar as hr_avatar')
                    ->get();
        $room_id = $request->room_id;
        $data_html = view('layout.applicantview.show_message_of_room_chat',compact('company_info','text_message','room_id'))->render();
        return response()->json(['data_html'=>$data_html]);
    }

    public function hr_show_message_by_room_id (Request $request){
        $applicant_info = DB::table('rooms_chat')
                        ->join('hrs','rooms_chat.hr_id','=','hrs.id')
                        ->join('applicants','rooms_chat.applicant_id','=','applicants.id')
                        ->where('rooms_chat.id',$request->room_id)
                        ->select('applicants.id as applicant_id','applicants.name as applicant_name','applicants.avatar as applicant_avatar')
                        ->first(); 
        $text_message = DB::table('chatting')
                    ->join('rooms_chat','chatting.room_id','=','rooms_chat.id')
                    ->join('hrs','rooms_chat.hr_id','=','hrs.id')
                    ->join('companies','hrs.id','=','companies.hr_id')
                    ->join('applicants','rooms_chat.applicant_id','=','applicants.id')
                    ->where('rooms_chat.id',$request->room_id)
                    ->select('chatting.text_message as text_message','chatting.from as from','chatting.created_at as created_at','applicants.id as applicant_id','applicants.name as applicant_name','applicants.avatar as applicant_avatar','hrs.id as hr_id','hrs.name as hr_name','companies.logo as company_logo')
                    ->get();
        $room_id = $request->room_id;
        $data_html = view('layout.hrview.show_message_of_room_chat',compact('applicant_info','text_message','room_id'))->render();
        return response()->json(['data_html'=>$data_html]);
    }
    


    public function updateStatusTextMessage(Request $request){
        $room_id = $request->room_id;
        if($request->from_to == 1){
            $update_status = DB::table('chatting')
                            ->where('room_id',$room_id)
                            ->where('from',0)
                            ->update(['status'=>1]);
        }
        if($request->from_to == 0){
            $update_status = DB::table('chatting')
                            ->where('room_id',$room_id)
                            ->where('from',1)
                            ->update(['status'=>1]);
        }
        return response()->json(['update_status'=>$update_status]);
    }


    public function count_chatting_message_not_seen(Request $request){
            if($request->from_to == 1){
                $count_chatting_message_not_seen = DB::table('chatting')
                                                    ->leftJoin('rooms_chat','chatting.room_id','=','rooms_chat.id')
                                                    ->where('rooms_chat.hr_id',$request->hr_id)
                                                    ->where('chatting.from',0)
                                                    ->where('chatting.status',0)
                                                    ->count();
            }
            if($request->from_to == 0){
                $count_chatting_message_not_seen = DB::table('chatting')
                                                    ->leftJoin('rooms_chat','chatting.room_id','=','rooms_chat.id')
                                                    ->where('rooms_chat.applicant_id',$request->applicant_id)
                                                    ->where('chatting.from',1)
                                                    ->where('chatting.status',0)
                                                    ->count();
            }
        return response()->json(['count_chatting_message_not_seen'=>$count_chatting_message_not_seen]);
    } 
 }
