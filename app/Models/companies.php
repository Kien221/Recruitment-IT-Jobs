<?php

namespace App\Models;
use App\Models\hr;
use App\Models\Post;
use App\Models\imagesCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class companies extends Model
{
    use HasFactory;
    protected $table = 'companies';
    public $fillable = [
        'hr_id',
        'name',
        'logo',
        'email',
        'phone',
        'website',
        'tax_code',
        'address',
        'number_of_employees',
        'industry',
        'city_id',
        'description_company',
    ];
    public $timestamps = false;
    public function post(){
        return $this->hasMany(Post::class,'company_id','id');
    }
    public function imagesCompany(){
        return $this->hasMany(imagesCompany::class);
    }
}
