<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $table = 'bills';
    protected $fillable = ['code','description','customer_name','customer_phone','discount','total_amount',
        'status','transaction_type','user_id','service_id','appointment_id','prescription_id','promotion_id'];
}
