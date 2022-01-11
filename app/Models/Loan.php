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
        'createdBy',
        'reserved_until',
        'user_confirmed',
        'renewed'
    ];

    protected $dates = ['created_at', 'updated_at', 'to', 'reserved_until'];
    
    public function user() {

        return $this->belongsTo(User::class);
    }

    public function books() {

        return $this->belongsToMany(Book::class);
    }
}
