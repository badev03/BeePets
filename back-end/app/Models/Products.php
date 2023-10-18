<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'quantity',
        'image',
        'product_categorie_id'
    ];
    public function Categories()
    {
        return $this->belongsTo(Product_categories::class, 'product_categorie_id');
    }
    public function order_detail()
    {
        return $this->hasMany(Order_detail::class, 'product_id');
    }

}
