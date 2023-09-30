<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_categories extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];
    public function products()
    {
        return $this->hasMany(Products::class, 'product_categorie_id');
    }
}
