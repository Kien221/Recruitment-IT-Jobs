<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    use HasFactory;
    public $fillable = ['id','apply_cvs_id','message','status'];
    public function apply_cv(){
        return $this->belongsTo(apply_cv::class,'apply_cvs_id','id');
    }
}
