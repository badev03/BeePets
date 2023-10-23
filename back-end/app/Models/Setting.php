<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_header',
        'image_footer',
        'address',
        'phone',
        'email',
        'description',
    ];
}
