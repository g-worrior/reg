<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\Business;
use App\Models\District;
use Laravelista\Comments\Commenter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'phonenumber',
        'district_id',
        'gender_id',
        'profile_picture',
        'email',
        'password',
        'role_as',
        'avatar'
    ];
    public function businesses(){
        return $this->hasOne(Business::class);
    }
    public function districts(){
        return $this->belongsTo(District::class, 'district_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','role_as'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
