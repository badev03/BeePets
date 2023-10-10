<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Work_schedule;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'doctors';
    protected $guard = 'doctors';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'description',
        'avatar',
        'status',
        'role_id',
        'gender',
    ];

    public function Work_schedule(){
        return $this->hasMany(Work_schedule::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id', 'id');
    }
    public function services() {
        return $this->belongsToMany(Service::class);
    }
    
}