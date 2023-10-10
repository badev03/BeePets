<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Type_pet;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Work_schedule;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;


class BookingController extends Controller
{


    public function showForm(Request $request)
{
    $service = Service::all();
    $typePets = Type_pet::all();
    $doctors = Doctor::all();

    $doctor_id = $request->input('doctor_id', 1);
    $date = $request->input('date');
    $selectedShift = $request->input('shift_name');
    $workSchedule = Work_schedule::where('doctor_id', $doctor_id)
        ->where('date', $date)
        ->where('shift_name', $selectedShift)->get();
       
    if ($workSchedule->count() > 0) {
        $now = now(); // Lấy thời gian hiện tại

        foreach ($workSchedule as $item) {
            $end_time = Carbon::parse($item->end_time);

            // So sánh thời gian kết thúc với thời gian hiện tại
            if ($now->greaterThan($end_time)) {
                return response()->json(['message' => 'Thời gian hiện tại đã vượt qua thời gian của ca làm việc'], 404);
            }
        }

        // Nếu chưa qua thời gian kết thúc của tất cả các ca làm việc, cho phép đặt cuộc hẹn
        return response()->json(compact('service', 'typePets', 'doctors', 'workSchedule'));
    } else {
        return response()->json(['message' => 'Không có lịch làm việc'], 404);
    }
}

    public function save(Request $request)
    {
        try {
            $this->validateBookingRequest($request);
            if (!auth()->check()) {
                $user = User::create([
                    'name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'password' => bcrypt('123456'),
                    'status' => 0,
                ]);
            } else if (auth()->user()->phone == $request->input('phone')) {
                return response()->json(['message' => 'Số điện thoại đã được đặt trước đó'], 404);
            } else {
                $user = auth()->user();
            }

            $model = new Appointment();
            $model->fill($request->all());
            $model->user_id = $user->id;
            $model->save();

            return response()->json(['message' => 'Đã tạo cuộc hẹn thành công'], 201);
        } catch (QueryException $e) {

            return response()->json(['message' => 'Lưu dữ liệu thất bại.'], 500);
        }
    }

    private function validateBookingRequest(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i:s',
            'shift_name' => 'required',
            'type_pet_id' => 'required|exists:type_pets,id',
            'service_id' => 'required|exists:services,id',
        ], [
            'required' => ':attribute không được để trống',
            'exists' => ':attribute không tồn tại',
            'date_format' => ':attribute không đúng định dạng',
        ]);
    }
}
