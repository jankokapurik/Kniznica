<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'approved',
        'from',
        'to',
        'createdBy'
    ];

    public function user() {

        return $this->belongsTo(User::class);
    }

    public function books() {

        return $this->belongsToMany(Book::class, 'book_loan');
    }
}
