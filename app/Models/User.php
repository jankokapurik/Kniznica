<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Knihy;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'username',
        'school_id',
        'classroom_id',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comments() {        
        return $this->hasMany(Comment::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function recievedLikes() {

        return $this->hasManyThrough(Like::class, Knihy::class);
    }

    public function classroom() {

        return $this->belongsTo(Classroom::class);
    }
    
    public function school() {

        return $this->belongsTo(School::class);
    }

    public function isAdmin() {
        
        return $this->user_type == "admin" ? true : false;
    }
}
