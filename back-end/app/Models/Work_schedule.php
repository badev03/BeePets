<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'slot_time',
        
        'start_time',
        'end_time',
        'doctor_id',
    ];
}
