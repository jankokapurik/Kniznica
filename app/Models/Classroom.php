<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory;
    
    protected $fillable = [
    ];

    public function user()
    {
        return $this->hasOne(Classroom::class);
    }

}
