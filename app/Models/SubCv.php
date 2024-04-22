<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCv extends Model
{
    use HasFactory;
    protected $table = 'sub_cv';
    protected $fillable = [
        'applicant_id',
        'typeCV',   
        'exp_year_work',
        'position_want_to_apply',
        'languages_want_to_apply',
        'city_want_to_work'
    ];
    public $timestamps = false;

}
