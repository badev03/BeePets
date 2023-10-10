<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor_service extends Model
{
    use HasFactory;
    protected $table = 'doctor_service';

    public function doctor() {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    public function service() {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
