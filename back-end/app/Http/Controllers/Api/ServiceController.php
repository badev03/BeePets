<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Traits\QueryCommon;
use Illuminate\Http\Request;

class ServiceController extends BaseResponseApiController
{
    use QueryCommon;
    public $model = Service::class;
    public $title = 'Dịch vụ';
    public function index()
    {
        $data = Service::select('services.id' , 'services.name' , 'services.slug' , 'services.description')
            ->join('service_categories' , 'service_categories.id' , '=' , 'services.service_categorie_id')
            ->where('service_categories.status' , '=' , 1)
            ->get();
        if(!$data) {
            return response()->json(['message' => $this->title.'không tồn tại'], 404);
        }
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
        if(!$data) {
            return response()->json(['message' => 'Dịch vụ không tồn tại'], 404);
        }
        return response()->json([
            'service' => $data],
            '200');
    }

    public function show(string $id) {
        $data = $this->tableQuery('services')
            ->select('services.id' , 'services.name' ,
                'services.slug' , 'services.description' , 'services.icon_svg' , 'services.image'
            , 'service_categories.id as service_categorie_id')
            ->join('service_categories' , 'service_categories.id' , '=' , 'services.service_categorie_id')
            ->where('service_categories.status' , '=' , 1)
            ->where('services.id', '=', $id)
            ->first();
        if(!$data) {
            return response()->json(['message' => 'Dịch vụ không tồn tại'], 404);
        }
        $relatedService = $this->tableQuery('services')
            ->select('services.id', 'services.name', 'services.slug', 'services.description', 'services.icon_svg', 'services.image')
            ->join('service_categories' , 'service_categories.id' , '=' , 'services.service_categorie_id')
            ->where('service_categories.status' , '=' , 1)
            ->where('services.service_categorie_id', '=', $data->service_categorie_id)
            ->where('services.id', '!=', $data->id)
            ->toRawSql();
        return response()->json([
            'service-detail' => $data ,'service-related' => $relatedService ],
            '200');
    }
}
