<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'releaseDate',
        'quantity'
    ];
    
    public function authors()
    {
        return $this->belongsTo(Author::class);
    }

    public function languages()
    {
        return $this->belongsTo(Language::class);
    }

    public function comments()
    {
        // return $this->hasMany(Comment::class)->latest()->get();
        return $this->hasMany(Comment::class);
    }
}