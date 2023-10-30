<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable=[
        'status',
        'description',
        'date',
        'time',
        'shift_name',
        'type_pet_id',
        'service_id',
        'doctor_id',
        'customer_name',
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
    public function type_pet()
    {
        return $this->belongsTo(Type_pet::class);
    }
    public function bill()
    {
        return $this->hasMany(Bill::class, 'appointment_id', 'id');
    }
    public function work_schedule(){
        return $this->belongsTo(Work_schedule::class,'shift_name','shift_name');
    }
}
