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
    public function detail(Request $request,$id){
        $detail_post = DB::table('posts')
                        ->join('companies','posts.company_id','=','companies.id')
                        ->select('posts.*','companies.*','posts.id as post_id')
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

       $relate_posts = Post::inRandomOrder()
                        ->join('companies','posts.company_id','=','companies.id')
                        ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
                        ->paginate(5);
        foreach($relate_posts as $relate_post){
            $relate_post->expired_post = Carbon::parse($relate_post->expired_post)->diffForHumans();
        }
        session()->put('post_id',$id);
        session()->put('slug',$detail_post->slug);
       return view('publicView.detail_post',compact('detail_post','images_company','review_company','relate_posts'));
    }
    public function ajax_paginate_posts_detail_page(){
        $posts = Post::inRandomOrder()
                        ->join('companies','posts.company_id','=','companies.id')
                        ->select('posts.*','companies.name as company_name','companies.logo as company_logo')
                        ->paginate(5);
        foreach($posts as $post){
            $post->expired_post = Carbon::parse($post->expired_post)->diffForHumans();
        }
        return response()->json($posts);
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
        $post = new Post();
        $post = Post::create([
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
        

        return redirect()->route('show.posted.view')->with('create_post_success','Tạo bài viết bà đăng tin thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
