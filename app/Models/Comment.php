<?php

namespace App\Models;

use App\Models\Books;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'rating',
        'comment' 

    ];

    public function likedBy(User $user) {
        return $this->likes->contains('users_id', $user->id);
    }

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function book() {

        return $this->belongsTo(Books::class);
    }

    // public function likes() {

    //     return $this->hasMany(Like::class);
    // }

    public function ownedBy(User $user) {

    }
}
