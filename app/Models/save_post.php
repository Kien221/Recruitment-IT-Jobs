<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class save_post extends Model
{
    use HasFactory;
    public $table = 'save_post';
    public $fillable = ['id','applicant_id','post_id'];
    public function applicants(){
        return $this->belongsTo(applicant::class,'applicant_id','id');
    }
    public function posts(){
        return $this->belongsTo(post::class,'post_id','id');
    }
}
