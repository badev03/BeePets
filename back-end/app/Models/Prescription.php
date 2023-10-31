<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
       
    ];
    public function products()
    {
        return $this->belongsToMany(Products::class);
    }
    public function bill()
    {
        return $this->hasOne(Bill::class);
    }
    public function prescription_products()
    {
        return $this->hasMany(Prescription_product::class);
    }
    public function bills()
    {
        return $this->belongsTo(Bill::class);
    }

    public function productss()
    {
        return $this->belongsToMany(Products::class, 'prescription_product', 'prescription_id', 'product_id')
            ->withPivot('quantity', 'price', 'instructions');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
