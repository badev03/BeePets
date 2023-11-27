<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class statisticController extends Controller
{

    // lấy ra thống kê
    public function statisticPetType()
    {
        $data = DB::table('appointments')
            ->join('type_pets', 'appointments.type_pet_id', '=', 'type_pets.id')
            ->select('type_pets.name', DB::raw('count(*) as total'))
            ->groupBy('type_pets.name')
            ->get();
        return response()->json($data);
    }

    public function statisticPetTypeByDate(Request $request)
    {
        try {
            $request->validate([
                'date' => 'sometimes|date', // sometimes: giữ giá trị mặc định nếu không được cung cấp
                'type_pet_id' => 'sometimes|exists:type_pets,id',
                'appointment_id' => 'sometimes|exists:appointments,id',
            ], [
                'date.date' => 'Ngày không hợp lệ',
                'type_pet_id.exists' => 'Loại thú cưng không tồn tại',
                'appointment_id.exists' => 'Lịch hẹn không tồn tại',
            ]);

            $date = $request->input('date', now()->toDateString()); // sử dụng ngày hiện tại nếu không có giá trị được cung cấp
            $dateExists = DB::table('appointments')
            ->whereDate('created_at', '=', $date)
            ->exists();

        if (!$dateExists) {
            return response()->json(['error' => 'Không có dữ liệu cho ngày được cung cấp'], 404);
        }
            $data = DB::table('appointments')
                ->join('type_pets', 'appointments.type_pet_id', '=', 'type_pets.id')
                ->select('type_pets.name', DB::raw('count(*) as total'))
                ->where('appointments.created_at', '>=', $date)
                ->groupBy('type_pets.name')
                ->get();

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function statisticService()
    {
        $data = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->select('services.name', DB::raw('count(*) as total'))
            ->groupBy('services.name')
            ->get();
        return response()->json($data);
    }
    public function statisticServiceByDate(Request $request)
    {
        try {
            $request->validate([
                'date' => 'sometimes|date', // sometimes: giữ giá trị mặc định nếu không được cung cấp
                'service_id' => 'sometimes|exists:services,id',
                'appointment_id' => 'sometimes|exists:appointments,id',
            ], [
                'date.date' => 'Ngày không hợp lệ',
                'service_id.exists' => 'Dịch vụ không tồn tại',
                'appointment_id.exists' => 'Lịch hẹn không tồn tại',

            ]);

            $date = $request->input('date', now()->toDateString()); // sử dụng ngày hiện tại nếu không có giá trị được cung cấp
            $dateExists = DB::table('appointments')
                ->whereDate('created_at', '=', $date)
                ->exists();

            if (!$dateExists) {
                return response()->json(['error' => 'Không có dữ liệu cho ngày được cung cấp'], 404);
            }

            $data = DB::table('appointments')
                ->join('services', 'appointments.service_id', '=', 'services.id')
                ->select('services.name', DB::raw('count(*) as total'))
                ->where('appointments.created_at', '>=', $date)
                ->groupBy('services.name')
                ->get();

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
