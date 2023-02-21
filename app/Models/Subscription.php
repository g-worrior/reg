<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table="subscriptions";

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
