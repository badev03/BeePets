<?php

namespace App\Models;

use App\Models\ServiceCategorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','slug','description','price'
    ];

    public function serviceCategorie(){
        return $this->belongsTo(Service_categorie::class,'service_categorie_id');
    }
}
