<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\applicant;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Str;
use App\Models\companies;
use Carbon\Carbon;
use App\Events\HrAcceptCv;
use Illuminate\Support\Facades\DB;
use App\Models\messages;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('hr_view.post_recruitment');
        
    }
    public function generateSlug(Request $request){
        try{
           $slug  = Str::slug($request->title);
           return response()->json(['slug'=> $slug]);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function detail($id,$slug){
        $detail_post = DB::table('posts')
                        ->join('companies','posts.company_id','=','companies.id')
                        ->leftJoin('hrs','companies.hr_id','=','hrs.id')
                        ->leftJoin('level_account','hrs.id','=','level_account.hr_id')
                        ->leftJoin('services','level_account.service_id','=','services.id')
                        ->select('posts.*','services.border_post as borderpost','services.hot_company as hot_company','companies.name as name','companies.logo as logo','companies.description_company as description_company','companies.number_of_employees as number_of_employees','companies.address as address')
                        ->where('posts.id',$id)
                        ->first();
        $detail_post->expired_post = Carbon::parse($detail_post->expired_post)->format('d-m-Y');
        $review_company = Post::inRandomOrder()
                        ->join('companies','posts.company_id','=','companies.id')
                        ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
                        ->first();
        $review_company->expired_post = Carbon::parse($detail_post->expired_post)->format('d-m-Y');
        $images_company = DB::table('images_companies')
                        ->join('companies','images_companies.company_id','=','companies.id')
                        ->select('images_companies.image')
                        ->where('companies.id',$detail_post->company_id)
                        ->get();
        session()->put('post_id',$id);
        session()->put('slug',$detail_post->slug);
       return view('publicView.detail_post',compact('detail_post','images_company','review_company'));
    }
    public function ajax_paginate_posts_random_detail_page(){
        Carbon::setLocale('vi');
        $posts = DB::table('posts')
                ->join('companies','posts.company_id','=','companies.id')
                ->leftJoin('hrs','companies.hr_id','=','hrs.id')
                ->leftJoin('level_account','hrs.id','=','level_account.hr_id')
                ->leftJoin('services','level_account.service_id','=','services.id')
                ->select('posts.*','services.border_post as borderpost','services.hot_company as hot_company','companies.name as company_name','companies.logo as company_logo')
                ->inRandomOrder()
                ->paginate(5);
        foreach($posts as $post){
            $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
        }
        return view('layout.api.paginate_posts',compact('posts'))->render();
    }
    
    public function ajax_paginate_posts_detail_page(){
        Carbon::setLocale('vi');
        $posts = DB::table('posts')
                ->join('companies','posts.company_id','=','companies.id')
                ->leftJoin('hrs','companies.hr_id','=','hrs.id')
                ->leftJoin('level_account','hrs.id','=','level_account.hr_id')
                ->leftJoin('services','level_account.service_id','=','services.id')
                ->select('posts.*','services.border_post as borderpost','services.hot_company as hot_company','companies.name as company_name','companies.logo as company_logo')
                ->inRandomOrder()
                ->paginate(5);
        foreach($posts as $post){
            $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
        }
        return view('layout.api.paginate_posts',compact('posts'))->render();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company_id = Companies::where('hr_id',session()->get('id_hr'))->first();
        Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'languages' => json_encode(request('languages')),
            'company_id' => $company_id->id,
            'city' => $request->city,
            'district' => $request->district,
            'position' => json_encode(request('position')),
            'work_type' => $request->work_type,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'unit_money' => $request->unit_money,
            'number_of_recruitment' => $request->number_of_recruitment,
            'expired_post' => $request->expired_post,
            'description' => $request->description,
            'requirement' => $request->requirement,
            'benefit' => $request->benefit,
        ]);
        
        return redirect()->route('show.posted.view')->with('create_post_success','Tạo bài tuyển dụng thành công');
    }
    public function search(Request $request){
        Carbon::setLocale('vi');
        if($request->search_by_language == null && $request->choice_city == null){
            $posts = Post::query()
                        ->join('companies','posts.company_id','=','companies.id')
                        ->where('position','like','%'.$request->search_by_positions.'%')
                        ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
                        ->orderBy('posts.id','desc')
                        ->get();
            foreach($posts as $post){
                $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
            }
            $html = view('layout.api.search_posts',compact('posts'))->render();
            return response()->json(['data'=>$html]);
        }
        if($request->search_by_positions == null && $request->choice_city == null){
            $posts = Post::query()
                        ->join('companies','posts.company_id','=','companies.id')
                        ->where('languages','like','%'.$request->search_by_language.'%')
                        ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
                        ->orderBy('posts.id','desc')
                        ->get();
            foreach($posts as $post){
                $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
            }
            $html = view('layout.api.search_posts',compact('posts'))->render();
            return response()->json(['data'=>$html]);
        }
        if($request->search_by_positions == null && $request->search_by_language == null){
            $posts = Post::query()
            ->join('companies','posts.company_id','=','companies.id')
            ->where('city','like','%'.$request->choice_city.'%')
            ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
            ->orderBy('posts.id','desc')
            ->get();
            foreach($posts as $post){
                $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
            }
            $html = view('layout.api.search_posts',compact('posts'))->render();
            return response()->json(['data'=>$html]);
        }
        if($request->search_by_positions == null){
            $posts = Post::query()
            ->join('companies','posts.company_id','=','companies.id')
            ->where('languages','like','%'.$request->search_by_languages.'%')
            ->where('city','like','%'.$request->choice_city.'%')
            ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
            ->orderBy('posts.id','desc')
            ->get();
            foreach($posts as $post){
                $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
            }
            $html = view('layout.api.search_posts',compact('posts'))->render();
            return response()->json(['data'=>$html]);
        }
        if($request->search_by_languages == null){
            $posts = Post::query()
            ->join('companies','posts.company_id','=','companies.id')
            ->where('position','like','%'.$request->search_by_positions.'%')
            ->where('city','like','%'.$request->choice_city.'%')
            ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
            ->orderBy('posts.id','desc')
            ->get();
            foreach($posts as $post){
                $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
            }
            $html = view('layout.api.search_posts',compact('posts'))->render();
            return response()->json(['data'=>$html]);
        }
        if($request->choice_city == null){
            $posts = Post::query()
            ->join('companies','posts.company_id','=','companies.id')
            ->where('position','like','%'.$request->search_by_positions.'%')
            ->where('languages','like','%'.$request->search_by_languages.'%')
            ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
            ->orderBy('posts.id','desc')
            ->get();
            foreach($posts as $post){
                $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
            }
            $html = view('layout.api.search_posts',compact('posts'))->render();
            return response()->json(['data'=>$html]);
        }
        $posts = Post::query()
        ->join('companies','posts.company_id','=','companies.id')
        ->where('position','like','%'.$request->search_by_positions.'%')
        ->where('languages','like','%'.$request->search_by_languages.'%')
        ->where('city','like','%'.$request->choice_city.'%')
        ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
        ->orderBy('posts.id','desc')
        ->get();
        foreach($posts as $post){
            $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
        }
        $html = view('layout.api.search_posts',compact('posts'))->render();
        return response()->json(['data'=>$html]);

    }
    public function edit_post_view($id,$slug){
        $post = Post::where('id',$id)->first();
        $company = Companies::where('id',$post->company_id)->first();
        $post->languages = json_decode($post->languages);
        $post->position = json_decode($post->position);
        $post->expired_post = Carbon::parse($post->expired_post)->format('Y-m-d');
        return view('hr_view.edit_post',compact('post','company'));
    }
    public function update_post(Request $request,$id){
        $post = Post::where('id',$id)->first();
        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'languages' => json_encode(request('languages')),
            'city' => $request->city,
            'district' => $request->district,
            'position' => json_encode(request('position')),
            'work_type' => $request->work_type,
            'min_salary' => $request->min_salary,
            'max_salary' => $request->max_salary,
            'unit_money' => $request->unit_money,
            'number_of_recruitment' => $request->number_of_recruitment,
            'expired_post' => $request->expired_post,
            'description' => $request->description,
            'requirement' => $request->requirement,
            'benefit' => $request->benefit,
        ]);
        return redirect()->route('post.edit',[$post->id,$post->slug])->with('update_post_success','Cập nhật bài tuyển dụng thành công');
    }
    public function delete_post($id){
        $apply_cvs_ids = DB::table('apply_cvs')->where('post_id', $id)->pluck('id');

        // Delete messages related to the apply_cvs_ids
        messages::whereIn('apply_cvs_id', $apply_cvs_ids)->delete();

        // Now you can delete the child records
        DB::table('apply_cvs')->where('post_id', $id)->delete();
        DB::table('report_post')->where('post_id', $id)->delete();
        DB::table('save_post')->where('post_id', $id)->delete();
        // And finally, delete the parent record
        DB::table('posts')->where('id', $id)->delete();
        return redirect()->route('show.posted.view')->with('delete_post_success','Xóa bài tuyển dụng thành công');
    }
}
