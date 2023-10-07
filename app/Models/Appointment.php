<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable=[
        'status',
        'description',
        'date',
        'time',
        'type_pet_id',
        'service_id',
        'doctor_id',
        'user_id',
        'day_appointments',
    ];
    public function Doctor() {
        return $this->belongsTo(Doctor::class , 'doctor_id');
    }

    public function User() {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function TypePet() {
        return $this->belongsTo(Type_pet::class , 'type_pet_id');
    }

    public function Service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
