<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class apply_cv extends Model
{
    use HasFactory;
    public $fillable = ['id','post_id','applicant_id','type_cv','file_cv','status','brief_introduce'];
    public function post(){
        return $this->belongsTo(Post::class,'post_id','id');
    }
    public function applicant(){
        return $this->belongsTo(applicant::class,'applicant_id','id');
    }
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
    }
}
