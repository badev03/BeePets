<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill_prescription extends Model
{
    use HasFactory;
    protected $table = 'bill_prescription';
    protected $fillable = [
        'bill_id',
        'prescription_id',
    ];
}
