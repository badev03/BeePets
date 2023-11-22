<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill_service extends Model
{
    use HasFactory;

    protected $table = 'bill_service';

    protected $fillable = [
        'bill_id',
        'service_id'
    ];
}
