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
        $services = Service::all();
        $typePets = Type_pet::all();
    
        $service_id = $request->input('service_id');
        $doctors = Doctor::whereHas('services', function ($query) use ($service_id) {
            $query->where('service_id', $service_id);
        })->get();
    
        if ($doctors->isEmpty()) {
            return response()->json(['message' => 'Không có bác sĩ nào có thể làm dịch vụ này'], 400);
        }
    
        $doctor_id = $request->input('doctor_id');
        $date = $request->input('date');
    
        $workSchedule = Work_schedule::where('doctor_id', $doctor_id)->where('date', $date)->get();
    
        if ($workSchedule->isEmpty()) {
            return response()->json(['message' => 'Không có lịch làm việc cho bác sĩ này vào ngày này'], 400);
        }
    
        $now = now(); 
        foreach ($workSchedule as $item) {
            $end_time = Carbon::parse($item->end_time);
    
            if ($now->greaterThan($end_time)) {
                return response()->json(['message' => 'Thời gian hiện tại đã vượt qua thời gian của ca làm việc'], 400);
            }
        }
    
      
    
        return response()->json([
            'message' => 'Lấy dữ liệu thành công',
            'data' => [
                'services' => $services,
                'type_pets' => $typePets,
                'doctors' => $doctors,
                'work_schedule' => $workSchedule,
            ]
        ], 200);
       
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
                return response()->json(['message' => 'Số điện thoại đã được đặt trước đó']);
                
            } else {
                $user = auth()->user();
            }

    
            $model = new Appointment();
            $model->fill($request->all());
            $model->user_id = $user->id;
            $model->save();
    
            return response()->json(['message' => 'Đã tạo cuộc hẹn thành công'], 201);
        } catch (QueryException $e) {
            dd($e->getMessage());
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

    public function getAppointments()
    {
        
        $data = Appointment::where('status', 1)->get();
        return response()->json(['message' => 'Lấy danh sách cuộc hẹn thành công', 'data' => $data], 200);

    }
    // lấy ra danh sách các cuộc hẹn có status = 0
    public function getAppointmentByStatus()
    {
        $data = Appointment::where('status', 0)->get();
        return response()->json(['message' => 'Lấy danh sách cuộc hẹn thành công', 'data' => $data], 200);
    }
    //lấy ra 1 cuộc hẹn
    public function getAppointment($id)
    {
        $data = Appointment::find($id);
        if (!$data) {
            return response()->json(['message' => 'Không tìm thấy cuộc hẹn'], 404);
        }

        return response()->json(['message' => 'Lấy cuộc hẹn thành công', 'data' => $data], 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $data = Appointment::find($id);
        if (!$data) {
            return response()->json(['message' => 'Không tìm thấy cuộc hẹn'], 404);
        }

        $data->status = $request->input('status');
        $data->save();

        return response()->json(['message' => 'Cập nhật trạng thái thành công'], 200);
    }



    


}
