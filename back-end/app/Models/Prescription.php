<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Prescription extends Model
{
    use HasFactory;
    protected $table = 'prescriptions';
    protected $fillable = [
        'name',
        'price',
        'date',
        'instructions',
        'quantity',
        'product_id',
    ];
public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }


}
