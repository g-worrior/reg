<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'business_name',
        'category_id',
        'business_type_id',
        'tax_clearance',
        'business_certificate',
        'ppda',
        'other_docs'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category(){
        return $this->belongsTo(User::class, 'category_id');
    }
    public function businesstype(){
        return $this->belongsTo(User::class, 'business_type__id');
    }
}
