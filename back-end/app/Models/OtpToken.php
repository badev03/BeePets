<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone' ,
        'otp_code' ,
        'expires_at' ,
        'user_id' ,
    ];
}
