<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\hr;
use App\Models\applicant;
use App\Models\chatting;

class roomChats extends Model
{
    use HasFactory;
    public $fillable = ['id','hr_id','applicant_id'];
    protected $table = 'rooms_chat';

    public function hr()
    {
        return $this->belongsTo(hr::class);
    }
    public function applicant()
    {
        return $this->belongsTo(applicant::class);
    }
    public function chatting()
    {
        return $this->hasMany(chatting::class);
    }
}
