<?php

namespace App\Models;

use App\Models\ServiceCategorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','slug','description','price' , 'image' ,'icon_svg' ,'service_categorie_id'
    ];

    public function serviceCategorie(){
        return $this->belongsTo(Service_categorie::class,'service_categorie_id');
    }
    public function bills()
    {
        return $this->belongsToMany(bill::class, 'bill_service', 'service_id', 'bill_id');
    }
    public function Categories(){
        return $this->belongsTo(Service_categorie::class,'service_categorie_id');
    }
   
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // public function doctors(){
    //     return $this->belongsToMany(Doctor::class,'doctor_service','service_id','doctor_id');
    // }
    public function doctors() {
        return $this->belongsToMany(Doctor::class);
    }

}
