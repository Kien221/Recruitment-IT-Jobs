<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\companies;
class HomeController extends Controller
{
    public function index(){
        Carbon::setLocale('vi');
        $count_post = Post::count();
        $num_jobs_by_city = Post::select('city',DB::raw('count(*) as total'))
                                ->groupBy('city')
                                ->orderBy('total','desc')
                                ->take(5)
                                ->get();

        $review_company = Post::inRandomOrder()
        ->join('companies','posts.company_id','=','companies.id')
        ->join('hrs','companies.hr_id','=','hrs.id')
        ->leftJoin('level_account','hrs.id','=','level_account.hr_id') // Changed this line
        ->join('services','level_account.service_id','=','services.id')
        ->select('posts.*','services.border_post as borderpost','services.hot_company as hot_company','companies.name as name','companies.logo as company_logo')
        ->first();
        if (!$review_company) {
            $review_company = Post::inRandomOrder()
                ->join('companies','posts.company_id','=','companies.id')
                ->select('posts.*', 'companies.name as name','companies.logo as company_logo')
                ->first();
        }
        $hot_companies = companies::inRandomOrder()->take(4)->DISTINCT('companies.id')->get();
        $hot_jobs =  DB::table('posts')
        ->join('companies','posts.company_id','=','companies.id')
        ->leftJoin('hrs','companies.hr_id','=','hrs.id')
        ->leftJoin('level_account','hrs.id','=','level_account.hr_id')
        ->leftJoin('services','level_account.service_id','=','services.id')
        ->select('posts.*','services.border_post as borderpost','services.hot_company as hot_company','companies.name as company_name')
        ->inRandomOrder() // Add this line
        ->paginate(3);
        if(session('post_id') && session('slug') != null){
            session()->forget('post_id');
            session()->forget('slug');
        }
        return view('publicView.index',compact('review_company','hot_companies','hot_jobs','count_post','num_jobs_by_city'));
    }
    public function ajax_get_all_jobs(){
        Carbon::setLocale('vi');
        $posts = DB::table('posts')
                ->join('companies','posts.company_id','=','companies.id')
                ->leftJoin('hrs','companies.hr_id','=','hrs.id')
                ->leftJoin('level_account','hrs.id','=','level_account.hr_id')
                ->leftJoin('services','level_account.service_id','=','services.id')
                ->select('posts.*','services.border_post as borderpost','services.hot_company as hot_company','companies.name as company_name','companies.logo as company_logo')
                ->orderby('posts.created_at','desc')
                ->paginate(10);
        $count_post = Post::count();
        foreach($posts as $post){
            $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
        }
        $html =  view('layout.api.paginate_posts',compact('posts','count_post'))->render();
        return response()->json($html);

    }

    public function ajax_paginate_posts(){
        Carbon::setLocale('vi');
        $posts = DB::table('posts')
        ->join('companies','posts.company_id','=','companies.id')
        ->leftJoin('hrs','companies.hr_id','=','hrs.id')
        ->leftJoin('level_account','hrs.id','=','level_account.hr_id')
        ->leftJoin('services','level_account.service_id','=','services.id')
        ->select('posts.*','services.border_post as borderpost','services.hot_company as hot_company','companies.name as company_name','companies.logo as company_logo')
        ->orderby('posts.created_at','desc')
        ->paginate(10);
        foreach($posts as $post){
            $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
            
        }
        return view('layout.api.paginate_posts',compact('posts'))->render();
    }
    public function ajax_paginate_hot_jobs(){
        $hot_jobs = DB::table('posts')
                    ->join('companies','posts.company_id','=','companies.id')
                    ->leftJoin('hrs','companies.hr_id','=','hrs.id')
                    ->leftJoin('level_account','hrs.id','=','level_account.hr_id')
                    ->leftJoin('services','level_account.service_id','=','services.id')
                    ->select('posts.*','services.border_post as borderpost','services.hot_company as hot_company','companies.name as company_name')
                    ->orderby('posts.created_at','desc')
                    ->inRandomOrder() // Add this line
                    ->paginate(3);
        return view('layout.api.paginate_hotjobs',compact('hot_jobs'))->render();
    }
    public function jobs_by_city(Request $request){
        Carbon::setLocale('vi');
        $posts_by_city = Post::where('city',$request->get('city'))
                        ->join('companies','posts.company_id','=','companies.id')
                        ->leftJoin('hrs','companies.hr_id','=','hrs.id')
                        ->leftJoin('level_account','hrs.id','=','level_account.hr_id')
                        ->leftJoin('services','level_account.service_id','=','services.id')
                        ->select('posts.*','services.border_post as borderpost','services.hot_company as hot_company','companies.name as company_name','companies.logo as company_logo')
                        ->orderby('posts.created_at','desc')
                        ->paginate(5);
                        foreach($posts_by_city as $post){
                            $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
                            
                        }
        $html = view('layout.api.jobs_by_city',compact('posts_by_city'))->render();
        return response()->json($html);
    }
    public function ajax_paginate_posts_by_city(Request $request){
        Carbon::setLocale('vi');
        $posts_by_city = Post::where('city',$request->get('city'))
                        ->join('companies','posts.company_id','=','companies.id')
                        ->leftJoin('hrs','companies.hr_id','=','hrs.id')
                        ->leftJoin('level_account','hrs.id','=','level_account.hr_id')
                        ->leftJoin('services','level_account.service_id','=','services.id')
                        ->select('posts.*','services.border_post as borderpost','services.hot_company as hot_company','companies.name as company_name','companies.logo as company_logo')
                        ->orderby('posts.created_at','desc')
                        ->paginate(5);
                        foreach($posts_by_city as $post){
                            $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
                            
                        }
        $html = view('layout.api.jobs_by_city',compact('posts_by_city'))->render();
        return response()->json($html);
    }
}
