<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class watch_cv extends Model
{
    use HasFactory;
    public $table = 'watch_cv';
    public $fillable = ['id','hr_id','applicant_id'];
    public function hrs(){
        return $this->belongsTo(hr::class,'hr_id','id');
    }
    public function applicants(){
        return $this->belongsTo(applicant::class,'applicant_id','id');
    }
}
