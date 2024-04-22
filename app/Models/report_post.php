<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class report_post extends Model
{
    use HasFactory;
    protected $table = 'report_post';
    protected $fillable = ['applicant_report_id','post_id','reason'];
    public $timestamps = false;
}
