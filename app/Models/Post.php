<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\companies;
class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'company_id',
        'languages',
        'city',
        'district',
        'position',
        'work_type',
        'min_salary',
        'max_salary',
        'unit_money',
        'number_of_recruitment',
        'expired_post',
        'description',
        'requirement',
        'benefit',
    ];
    public function company(){
        return $this->belongsTo(companies::class,'company_id','id');
    }
    
}
