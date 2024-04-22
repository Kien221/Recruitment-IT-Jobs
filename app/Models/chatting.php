<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\roomChats;
class chatting extends Model
{
    use HasFactory;
    public $fillable = ['room_id','text_message','from','status','created_at','updated_at'];
    protected $table = 'chatting';

    public function roomChats()
    {
        return $this->belongsTo(roomChats::class);
    }
}
