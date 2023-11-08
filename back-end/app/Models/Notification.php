<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'user_id' ,
        'message',
        'doctor_id',
        'message_doctor',
        'message_admin',
        'read',
        'read_user',
        'delete_user',
        'delete_doctor',
        'appointment_id',
    ];
}
