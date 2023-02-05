<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\applicant;
use App\Http\Requests\StoreapplicantRequest;
use App\Http\Requests\UpdateapplicantRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id){
        $user = applicant::find($user_id);
        return view('applicantview.index',compact('user'));
    }
    public function edit_cv_view(Request $request){
        $cv_user = applicant::find(session::get('id_aplicant'));
        return view('applicantview.editCvProfile',compact('cv_user'));
    }
    public function update_infor($user_id,Request $request){
        $update_user = applicant::find($user_id);
        $input = $request->all();
        if($request->has('avatar')){
            if($update_user->avatar != null){
                Storage::delete('public/'.$update_user->avatar);
                $avatar = $request->file('avatar')->store('applicant','public');
                $input['avatar'] = $avatar;
                session()->put('update_avatar','update_avatar');
                session()->forget('avatar');
                session()->put('avatar',$avatar);
            }
            else{
                $avatar = $request->file('avatar')->store('applicant','public');
                $input['avatar'] = $avatar;
                session()->put('update_avatar','update_avatar');
                session()->forget('avatar');
                session()->put('avatar',$avatar);
            }
        }
        $update_user->fill($input);
        $update_user->save();
        return redirect()->route('applicantView');
    }
    public function update_introdeyourself($user_id,Request $request){
        dd($request->all());
    }
    public function update_degree($user_id,Request $request){

    }
    public function update_exp($user_id,Request $request){

    }
    public function update_language($user_id,Request $request){

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreapplicantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreapplicantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(applicant $applicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateapplicantRequest  $request
     * @param  \App\Models\applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateapplicantRequest $request, applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(applicant $applicant)
    {
        //
    }
}
