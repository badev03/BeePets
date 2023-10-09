<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends BaseResponseApiController
{
    public $model = Service::class;


    public function index()
    {
        $data = Service::select('services.id' , 'services.name' , 'services.slug' , 'services.description')
            ->join('service_categories' , 'service_categories.id' , '=' , 'services.service_categorie_id')
            ->where('service_categories.status' , '=' , 1)
            ->get();
        return response()->json([
            'service' => $data],
            '200');
    }

    public function showHome() {
        $data = Service::limit(4)
                ->select('services.id' , 'services.name' , 'services.slug' , 'services.description' , 'services.icon_svg')
                ->join('service_categories' , 'service_categories.id' , '=' , 'services.service_categorie_id')
                ->where('service_categories.status' , '=' , 1)
                ->get();
        return response()->json([
            'service' => $data],
            '200');
    }
}
