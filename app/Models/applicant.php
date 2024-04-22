<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
class applicant extends Model
{
    public $fillable = ['id','name','avatar','email','password','gender','phoneNumber','address',
                        'city','filecv','links','introduce_yourself','study_degree',
                        'experience','hobby','certificate','perfection_level','status_public_cv','status_account'];
    use HasFactory;
    public function apply_cvs(){
        return $this->hasMany(apply_cv::class,'applicant_id','id');
    }
}
