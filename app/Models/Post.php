<?php

namespace App\Models;

use Laravelista\Comments\Commentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, Commentable;
    protected $fillable = ['title', 'body', 'user_id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
