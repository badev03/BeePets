<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = ['quantity','unit_price','product_id','bill_id'];

    public function product(){
        return $this->belongsTo(Products::class,'product_id');
    }
    public function bill(){
        return $this->belongsTo(Bill::class,'bill_id');
    }

}
