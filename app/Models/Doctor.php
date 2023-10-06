<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'description',
        'avatar',
        'status',
        'role_id',
        'gender',
    ];

    public function Appointment()
    {
        return $this->belongsTo(Appointment::class, 'doctor_id');
    }
    public function Work_schedule(){
        return $this->hasMany(Work_schedule::class);
    }
}
