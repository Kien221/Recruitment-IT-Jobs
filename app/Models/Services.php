<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    public $table = 'services';
    public $fillable = [
        'id',
        'name',
        'view_every_day',
        'search_every_day',
        'price',
        'benefit',
        'expired_service',
        'hot_company',
        'border_post',
    ];
    public $timestamps = false;
    use HasFactory;
}
