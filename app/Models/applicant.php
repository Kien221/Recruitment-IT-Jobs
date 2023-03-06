<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applicant extends Model
{
    public $fillable = ['id','name','avatar','email','password','gender','phoneNumber','address',
                        'city','filecv','links','introduce_yourself','study_degree',
                        'experience','hobby','certificate','perfection_level'];
    use HasFactory;
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
    }
}
