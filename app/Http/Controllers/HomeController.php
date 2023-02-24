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
        $posts = DB::table('posts')
                ->join('companies','posts.company_id','=','companies.id')
                ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
                ->orderby('posts.created_at','desc')
                ->paginate(5);
        Carbon::setLocale('vi');
        $review_company = Post::inRandomOrder()
                        ->join('companies','posts.company_id','=','companies.id')
                        ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
                        ->first();
        $hot_companies = companies::inRandomOrder()->take(4)->get();
        $hot_jobs = Post::inRandomOrder()->take(3)->paginate(3);
        return view('publicView.index',compact('posts','review_company','hot_companies','hot_jobs'));
    }
}
