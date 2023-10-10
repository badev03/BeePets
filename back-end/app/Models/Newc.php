<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newc extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'public_date',
        'image',
        'new_categorie_id',
    ];
    public function Categories() {
        return $this->belongsTo(New_categorie::class , 'new_categorie_id');
    }
}
