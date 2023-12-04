<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service_categorie extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','slug','description','cate_image','status'
    ];
    public function service(){
        return $this->hasMany(Service::class);
    }
}
