<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bills';
    protected $fillable = ['code','description','customer_name','customer_phone','discount','total_amount',
        'payment_method',
        'status','transaction_type','user_id','service_id','appointment_id','promotion_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'bill_service', 'bill_id', 'service_id');
    }
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }
    public function prescriptions(){
        return $this->hasMany(Prescription::class,'bill_id');
    }
    public function order_detail(){
        return $this->hasMany(Order_detail::class,'bill_id');
    }
    public function promotion(){
        return $this->belongsTo(Promotion::class,'promotion_id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

}
