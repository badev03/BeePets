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
   
}
