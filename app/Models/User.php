<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Knihy;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
        return $this->belongsTo(Classroom::class)->withTrashed();
    }
    
    public function school() {
        return $this->belongsTo(School::class)->withTrashed();
    }

    public function isAdmin() {
        return $this->user_type == "admin" ? true : false; // ? true : false odstranit?
    }

    public function loan() {

        return $this->hasOne(Loan::class);
    }

    public function hasLoan() {

        return $this->loan->contains('user_id', auth()->user()->id);
    }


    public function sendEmailVerificationNotification(){
        dd("email here");
        $this->notify(new App\Notifications\Custom);        
    }
}
