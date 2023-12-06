<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id' ,
        'user_id',
        'content',
        'score',
        'status',
        'is_trash'
    ];
}
