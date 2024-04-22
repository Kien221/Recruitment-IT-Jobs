<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\companies;
use App\Models\Post;
class hr extends Model
{
    use HasFactory;
    protected $fillable = ['name','avatar','email','password','phoneNumber','address','status','num_faul','token'];
    public $timestamps = false;
    protected $table = 'hrs';
    public function company(){
        return $this->hasOne(companies::class);
    }
}
