<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applicant extends Model
{
    public $fillable = ['id','name','avatar','email','password','gender','phoneNumber','address',
                        'city_id','filecv','links','introduce_yourself','study_degree',
                        'experience','hobby','certificate'];
    use HasFactory;
}
