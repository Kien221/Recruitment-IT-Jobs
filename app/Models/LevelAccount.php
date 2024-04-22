<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelAccount extends Model
{
    public $table = 'level_account';
    public $fillable = [
        'id',
        'hr_id',
        'service_id',
        'used_views',
        'used_search',
    ];
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(hr::class);
    }
    use HasFactory;
}
