<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'author_id',
        'title',
        'releaseDate',
        'quantity',
        'language_id',
        'image',
        'description',
        'created_by',
    ];
    
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class)->withTrashed();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function countComments()
    {
        return $this->hasMany(Comment::class)->count();
    }

    public function rating()
    {
        return $this->hasMany(Comment::class)->avg('rating');
    }

    public function genres() {
        
        return $this->belongsToMany(Genre::class, 'book_genre')->withTrashed();
    }

    // public function loans() {
        
    //     return $this->belongsToMany(Loan::class,);
    // }
}