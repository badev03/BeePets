<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable=[
        'status',
        'description',
        'date',
        'time',
        'shift_name',
        'type_pet_id',
        'service_id',
        'doctor_id',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function bill(){
        return $this->hasOne(Bill::class);
    }
}
