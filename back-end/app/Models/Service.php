<?php

namespace App\Models;

use App\Models\ServiceCategorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','slug','description','price' , 'image' , 'service_categorie_id'
    ];

    public function serviceCategorie(){
        return $this->belongsTo(Service_categorie::class,'service_categorie_id');
    }

    public function Categories(){
        return $this->belongsTo(Service_categorie::class,'service_categorie_id');
    }
<<<<<<< HEAD:BackEnd/app/Models/Service.php


=======
  

    public function doctors(){
        return $this->belongsToMany(Doctor::class,'doctor_service','service_id','doctor_id');
    }
>>>>>>> 047c75ac26cd70dbd5e4368e70e9ee4d40acacdc:back-end/app/Models/Service.php
}
