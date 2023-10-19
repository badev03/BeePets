<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription_product extends Model
{
    use HasFactory;
    protected $table = 'prescription_product';
    protected $fillable = [
        'prescription_id', // Fixed the typo here
        'product_id',
        'quantity',
        'price',
        'instructions'
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class, 'prescription_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

