<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Traits\QueryCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends BaseResponseApiController
{
    use QueryCommon;
    public $model = Service::class;
    public $title = 'Dịch vụ';
    public function index()
    {
        $data = Service::select('services.id' , 'services.name' , 'services.slug' , 'services.description' ,  'services.image')
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

    //lấy ra tất cả dịch vụ






    public function showHome() {
        $data = Service::limit(4)
                ->select('services.id' , 'services.name' , 'services.slug' , 'services.description' , 'services.icon_svg' ,  'services.image')
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

    public function show(string $slug) {
        $data = $this->tableQuery('services')
            ->select('services.id' , 'services.name' ,
                'services.slug' , 'services.description' , 'services.icon_svg' , 'services.image'
            , 'service_categories.id as service_categorie_id')
            ->join('service_categories' , 'service_categories.id' , '=' , 'services.service_categorie_id')
            ->where('service_categories.status' , '=' , 1)
            ->where('services.slug', '=', $slug)
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
            ->get();
        return response()->json([
            'service-detail' => $data ,'service-related' => $relatedService ],
            '200');
    }

    public function filterService() {
        $service = $this->tableQuery('services')->get();
        if(!$service) {
            return response()->json(['message' => 'Dịch vụ không tồn tại'], 404);
        }
        return response()->json([
            'service' => $service ],
            '200');
    }

    public function filterServiceDoctor() {
        return view('api.filter');
    }

    public function filterServiceDoctorPost(Request $request) {
        dd($request->all());
    }

    public function filterDoctorService(Request $request){
        $service = $request->input('service');
        // $service = json_decode($service, true);
        if($service) {
            $checkService = $this->tableQuery('doctor_service')
                ->select('doctors.name' , 'doctors.address' , 'doctors.image' , DB::raw('GROUP_CONCAT(services.name) AS chuyenkhoa'))
                ->join('services' , 'services.id' , '=' , 'doctor_service.service_id')
                ->join('doctors' , 'doctors.id' , '=' , 'doctor_service.doctor_id')
                ->join('service_categories' , 'service_categories.id' , '=' , 'services.service_categorie_id')
                ->where('service_categories.status' , '=' , 1)
                ->whereIn('doctor_service.service_id' ,$service )
                ->groupBy('doctors.name' , 'doctors.address' , 'doctors.image')
                ->get();
                if( $checkService){
                    return response()->json([
                        'service' => $checkService ],
                        '200');
                }else{
                    return response()->json([
                        'msg' => "Lỗi" ],
                        '400');
                }
        }
    }
}