<?php

namespace App\Http\Controllers;

use App\Models\applicant;
use Faker\Provider\ar_EG\Company;
use Illuminate\Http\Request;
use App\Models\admin; // Import the missing class
use App\Models\LevelAccount;
use App\Models\companies;
use App\Models\Post;
use Carbon\Carbon; // Import the Carbon class
use Yajra\DataTables\DataTables; // Import the missing class
use Illuminate\Support\Facades\DB; // Import the missing class
use App\Models\apply_cv;
use App\Models\messages;  // Import the missing class
use App\Models\hr;
use App\Models\Services;
use Illuminate\Support\Facades\Redirect;
use App\Models\Emails;
use App\Events\AdminSendEmailNotifyEvent;
class adminController extends Controller
{
    public function index_admin_view(){
       $totalRevenue = LevelAccount::join('services', 'level_account.service_id', '=', 'services.id')
        ->sum(\DB::raw('services.price'));
        $total_company = companies::all()->count();
        $total_post = Post::all()->count();
        $total_applicant = applicant::all()->count();
        return view('admin.index_admin',compact('totalRevenue','total_company','total_post','total_applicant'));
    }
     public function check_login(Request $request){
        $admin = admin::query()
                ->where('email',$request->get('email'))
                ->where('password',$request->get('password'))
                ->first();
        if($admin){
            $captcha = $request -> get('captcha');
            if($captcha == session('phrase')){
               session()->put('admin_id',$admin->id);
               session()->put('admin_name',$admin->name);
               session()->put('admin_avatar',$admin->avatar);
               return redirect()->route('admin.index.view');
            }
            else{
                return redirect()->back()->with('error_captcha','Mã xác nhận không đúng');  
            } 
        }
        else return redirect()->back()->with('error_pw_password','email hoặc mật khẩu không đúng');
    }

    public function management_post(){
        return view('admin.management_post');
    }
    public function post_api(){
        $list_post = DB::table('posts')
                    ->join('companies','posts.company_id','=','companies.id')
                    ->orderBy('posts.created_at','asc')
                    ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
                    ->get();
    return DataTables::of($list_post)
    ->editColumn('logo', function ($list_post) {
        return '<img src="'.asset('storage/'.$list_post->company_logo).'" width="100px" height="100px">';
    })
    ->addColumn('stt',function($list_post){
        return 1;
    })
    ->editColumn('name_company',function($list_post){
        return $list_post->company_name;
    })
    ->editColumn('title', function($list_post) {
        $title = '<a href="'.route('post.detail', [$list_post->id, $list_post->slug]).'">'.$list_post->title.'</a>';
        return $title;
    })
    ->editColumn('report_num',function($list_post){
        return $list_post->num_report;
    })
    ->editColumn('created_at',function($list_post){
        return Carbon::parse($list_post->created_at)->format('d/m/Y');
    })
    ->addColumn('delete',function($list_post){
        return route('admin.post.destroy',$list_post->id);
    })
    ->rawColumns(['logo','delete','title'])
    ->make(true);
    }
    public function destroy($id){
      // Get all apply_cvs_ids for the post
        $apply_cvs_ids = DB::table('apply_cvs')->where('post_id', $id)->pluck('id');

        // Delete messages related to the apply_cvs_ids
        messages::whereIn('apply_cvs_id', $apply_cvs_ids)->delete();

        // Now you can delete the child records
        DB::table('apply_cvs')->where('post_id', $id)->delete();
        DB::table('report_post')->where('post_id', $id)->delete();

        // And finally, delete the parent record
        DB::table('posts')->where('id', $id)->delete();
        return redirect()->route('management.post');
    }

    public function management_company(){
        return view('admin.management_company');
    }

    public function company_api(){
        $list_company = companies::all();
        return DataTables::of($list_company)
        ->addColumn('stt',function($list_company){
            return 1;
        })
        ->editColumn('logo', function ($list_company) {
            return '<img src="'.asset('storage/'.$list_company->logo).'" width="100px" height="100px">';
        })
        ->editColumn('name_company',function($list_company){
            return $list_company->name;
        })
        ->editColumn('report_num',function($list_company){
            return $list_company->hr->num_faul;
        })
        ->addColumn('block_up_post',function($list_company){
            return route('admin.company.block_up_post',$list_company->id);
        })
        ->rawColumns(['logo','block_up_post'])
        ->make(true);
    }
    public function block_up_post($id){
        $company = companies::find($id);
        if($company->status == 1){
            $company->status = 0;
            $company->save();
            return redirect()->route('management.company');
        }
        else{
            $company->status = 1;
            $company->save();
            return redirect()->route('management.company');
        }
    }
    public function management_hr(){
        return view('admin.management_user.management_hr');
    }
    public function management_hr_indexApi(){
        $list_hr = DB::table('hrs')
                    ->leftJoin('companies', 'companies.hr_id', '=', 'hrs.id')
                    ->leftJoin('level_account', 'hrs.id', '=', 'level_account.hr_id')
                    ->leftJoin('services', 'services.id', '=', 'level_account.service_id')
                    ->select('hrs.*', 'companies.name as company_name', 'services.name as service_name', 'companies.logo as company_logo')
                    ->get();
        return DataTables::of($list_hr)
        ->addColumn('stt',function($list_hr){
            return 1;
        })
        ->editColumn('avatar', function ($list_hr) {
            return '<img src="'.asset('storage/images/'.$list_hr->avatar).'" width="100px" height="100px">';
        })
        ->editColumn('email',function($list_hr){
            return $list_hr->email;
        })
        ->editColumn('company',function($list_hr){
            return $list_hr->company_name;
        })
        ->editColumn('service',function($list_hr){
            return $list_hr->service_name;
        })
        ->editColumn('num_faul',function($list_hr){
            return $list_hr->num_faul;
        })
        ->addColumn('block_account',function($list_hr){
            return route('admin.management_hr.block_account',$list_hr->id);
        })
        ->rawColumns(['avatar','block_account'])
        ->make(true);
    
    }
    public function block_account($id){
        $hr = hr::find($id);
        if($hr->status == 1){
            $hr->status = 0;
            $hr->save();
            return redirect()->route('management.hr');
        }
        else{
            $hr->status = 1;
            $hr->save();
            return redirect()->route('management.hr');
        }
    }
    public function management_applicant(){
        return view('admin.management_user.management_applicant');
    }
    public function management_applicant_indexApi(){
        $list_applicant = Applicant::withCount('apply_cvs')->get();
        return DataTables::of($list_applicant)
        ->addColumn('stt',function($list_applicant){
            return 1;
        })
        ->editColumn('avatar', function ($list_applicant) {
            return '<img src="'.asset('storage/'.$list_applicant->avatar).'" width="100px" height="100px">';
        })
        ->editColumn('email',function($list_applicant){
            return $list_applicant->email;
        })
        ->editColumn('city',function($list_applicant){
            return $list_applicant->city;
        })
        ->editColumn('num_job_apply',function($list_applicant){
            return $list_applicant->apply_cvs_count;
        })
        ->addColumn('block_account',function($list_applicant){
            return route('admin.management_applicant.block_account',$list_applicant->id);
        })
        ->rawColumns(['avatar','block_account'])
        ->make(true);
    }
    public function block_account_applicant($id){
        $applicant = applicant::find($id);
        if($applicant->status_account == 1){
            $applicant->status_account = 0;
            $applicant->save();
            return redirect()->route('management.applicant');
        }
        else{
            $applicant->status_account = 1;
            $applicant->save();
            return redirect()->route('management.applicant');
        }
    }
    public function management_services(){
        return view('admin.management_service.management_services');
    }

    public function management_services_indexApi(){
        $list_services = DB::table('services')
                        ->leftJoin('level_account', 'services.id', '=', 'level_account.service_id')
                        ->select('services.id', 'services.name', 'services.price', 'services.expired_service', DB::raw('count(level_account.service_id) as service_count'))
                        ->groupBy('services.id', 'services.name', 'services.price', 'services.expired_service')
                        ->get();
        return DataTables::of($list_services)
        ->addColumn('stt',function($list_services){
            return 1;
        })
        ->editColumn('name',function($list_services){
            return $list_services->name;
        })
        ->editColumn('price',function($list_services){
            return number_format($list_services->price);
        })
        ->editColumn('time',function($list_services){
            return $list_services->expired_service;
        })
        ->editColumn('buy',function($list_services){
            return $list_services->service_count;
        })
        ->editColumn('edit',function($list_services){
            return route('admin.management_services.edit',$list_services->id);
        })
        ->editColumn('delete',function($list_services){
            return route('admin.management_services.delete',$list_services->id);
        })
        ->rawColumns(['edit','delete'])
        ->make(true);
    }
    public function edit_services_view($id){
        $service = DB::table('services')->where('id',$id)->first();
        return view('admin.management_service.edit_service',compact('service'));
    }
    public function edit_services(Request $request,$id){
        $service = Services::find($id);
        $service->name = $request->get('name');
        $service->introduce_service = $request->get('introduce_service');
        $price = str_replace(',', '', $request->get('price'));
        $service->price = $price;
        $service->expired_service = $request->get('expired_service');
        if($request->hot_company != null){
            $service->hot_company = 1;
        }
        else{
            $service->hot_company = 0;
        }
        if($request->border_post != null){
            $service->border_post = 1;
        }
        else{
            $service->border_post = 0;
        }
        $service->save();
        return Redirect::back()->with('success', 'Cập nhật gói dịch vụ thành công');
    }
    public function notify_event_view(){
        return view('admin.email_notify_event.email_notify_event_index_view');
    }

    public function email_notify_event_indexApi(){
        $list_notify = DB::table('emails')
                    ->orderBy('created_at','desc')
                    ->get();
        return DataTables::of($list_notify)
        ->addColumn('stt',function($list_notify){
            return 1;
        })
        ->editColumn('title',function($list_notify){
            return $list_notify->title;
        })
        ->editColumn('content',function($list_notify){
            return $list_notify->content;
        })
        ->editColumn('created_at',function($list_notify){
            return Carbon::parse($list_notify->created_at)->format('d/m/Y');
        })
        ->editColumn('edit',function($list_notify){
            return route('admin.notify_event.edit',$list_notify->id);

        })
        ->editColumn('delete',function($list_notify){
            return route('admin.notify_event.delete',$list_notify->id);

        })
        ->rawColumns(['delete'])
        ->make(true);
    }
    public function notify_event_create_view(){
        return view('admin.email_notify_event.email_notify_event_create_view');
    }

    public function notify_event_edit_view($id){
        $email_notify_event = DB::table('emails')->where('id',$id)->first();
        return view('admin.email_notify_event.email_notify_event_edit_view',compact('email_notify_event'));
    }
    public function email_notify_event_update(Request $request,$id){
        $email_notify_event = emails::find($id);
        $email_notify_event->title = $request->get('title');
        $email_notify_event->content = $request->get('content');
        $email_notify_event->save();
        return Redirect::back()->with('success', 'Cập nhật email thông báo thành công');
    }
    public function notify_event_delete($id){
        $notify = DB::table('emails')->where('id',$id)->delete();
        return redirect()->route('notify.event')->with('success','Xóa email thông báo thành công');
    }
    public function email_notify_event_store(Request $request){
        $email_notify_event = new emails();
        $email_notify_event->title = $request->get('title');
        $email_notify_event->content = $request->get('content');
        $email_notify_event->save();
        event(new AdminSendEmailNotifyEvent($request->get('title')));
        return redirect()->route('notify.event')->with('success','Thêm email thông báo thành công');
    }

}
