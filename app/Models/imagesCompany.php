<?php

namespace App\Models;
use App\Models\companies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imagesCompany extends Model
{
    use HasFactory;
    public $fillable = [
        'company_id',
        'image',
    ];
    protected $table = 'images_companies';
    public $timestamps = false;
    public function company(){
        return $this->belongsTo(companies::class);
    }
    
}
