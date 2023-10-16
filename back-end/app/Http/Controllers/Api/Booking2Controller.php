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

class Booking2Controller extends Controller
{
    public function getWorkScheduleDoctor(Request $request)
    { 
        $doctor_slug = $request->input('slug');
        $inforDoctor = Doctor::where('slug', $doctor_slug)->select('id', 'name', 'avatar', 'slug')->first();
        $doctor_id = $inforDoctor->id;
        $selectedDate = $request->input('date'); // Ngày được chọn bởi người dùng
      
        // Xác định ngày cụ thể hoặc sử dụng ngày hiện tại nếu không có ngày được chọn
        $date = $selectedDate ? Carbon::parse($selectedDate)->toDateString() : now()->toDateString();
        
        $service = Service::where('id', $doctor_id)->select('id', 'name', 'price')->get();
        if ($service->isEmpty()) {
          return response()->json(['message' => 'Không có dịch vụ nào của bác sĩ này'], 400);
      }
       $typePet = Type_pet::select('id', 'name')->get();
        if($typePet->isEmpty()){
          return response()->json(['message' => 'Không có loại thú cưng nào'], 400);
      }
        // Lấy ra lịch làm việc của bác sĩ theo ngày
        $work_schedule = Work_schedule::where('doctor_id', $doctor_id)->where('date', $date)->get();
        if ($work_schedule->isEmpty()) {
            return response()->json(['message' => 'Không có lịch làm việc của bác sĩ vào ngày đã chọn'], 400);
        } else {
            return response()->json([
                'message' => 'Lấy danh sách lịch làm việc thành công', 
                'workSchedule' => $work_schedule,
                'inforDoctor' => $inforDoctor,
                'service' => $service,
                'typePet' => $typePet
            ], 200);
               
        }
    }

 

    public function save(Request $request)
    {
        try {
            $this->validateBookingRequest($request);
            $name = $request->input('name');
            $phone = $request->input('phone');

            if (User::where('phone', $phone)->exists()) {
                $user = User::where('phone', $phone)->first();
                $user_id = $user->id;
            } else {
                $user = new User();
                $user->name = $name;
                $user->phone = $phone;
                $user->password = bcrypt('123456');
                $user->status = 1;
                $user->role_id = 4;
                $user->save();
                $user_id = $user->id;
            }
            $model = new Appointment();
            $model->fill(array_merge($request->all(), [
                'user_id' => $user_id,
                'status' => 0,
            ]));

            $model->save();

            return response()->json(['message' => 'Đã tạo cuộc hẹn thành công'], 201);
        } catch (QueryException $e) {
            // dd($e->getMessage());
            return response()->json(['message' => 'Lưu dữ liệu thất bại.'], 500);
        }
    }

   


}
