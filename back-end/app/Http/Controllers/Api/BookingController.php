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


    // lấy ra tên vaz tất cả dịch vụ và các bác sĩ làm được dịch vụ đó
    public function services()
    {
        $data = Service::select('id','name','price')->with('doctors')->get();
        return response()->json(['message' => 'Lấy danh sách dịch vụ thành công', 'data' => $data], 200);
    }



    public function typePets()
    {
        $data = Type_pet::select('id', 'name')->get();
        return response()->json(['message' => 'Lấy danh sách loại thú cưng thành công', 'data' => $data], 200);
    }

    public function doctors(Request $request)
    {
        $service_id = $request->input('service_id');
        $date = $request->input('date');
        $doctors = Doctor::select('id', 'name', 'status')->with(['work_schedule' => function ($query) use ($date) {
            $query->where('date', $date);
        }])->whereHas('services', function ($query) use ($service_id) {
            $query->where('service_id', $service_id);
        })->get();
        if ($doctors->isEmpty()) {
            return response()->json(['message' => 'Không có bác sĩ nào'], 400);
        }
        return response()->json(['message' => 'Lấy danh sách bác sĩ thành công', 'data' => $doctors], 200);
    }
   

    // lấy ra lịch làm việc của bác sĩ theo ngày
    public function workSchedule(Request $request)
    {
        $doctor_id = $request->input('doctor_id');
        $date = $request->input('date');
        $work_schedule = Work_schedule::where('doctor_id', $doctor_id)->where('date', $date)->get();
        if ($work_schedule->isEmpty()) {
            return response()->json(['message' => 'Không có lịch làm việc của bác sĩ này'], 400);
        }
        return response()->json(['message' => 'Lấy danh sách lịch làm việc thành công', 'data' => $work_schedule], 200);
    }



    // thêm name và phone của khách hàng từ input còn nếu đang đăng nhập thì lấy thông tin của khách hàng đó
    public function addNamePhone(Request $request)
{
    $user = null;

    if (!auth()->check()) {
        $user = User::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'password' => bcrypt('123456'),
            'status' => 0,
        ]);
    } else if (auth()->user()->phone == $request->input('phone') && auth()->user()->status == 0) {
        return response()->json(['message' => 'Số điện thoại đã được đặt trước ']);
    } else if (auth()->user()->phone == $request->input('phone') && auth()->user()->status == 1) {
        return response()->json(['message' => 'hãy đăng nhập để đặt lịch khám']);
    } else {
        $user = auth()->user();
    }

    return response()->json(['message' => 'Thêm tên và số điện thoại thành công', 'data' => $user], 200);
}


    // lưu dữ liệu đã chọn vào bảng appointment
    public function save(Request $request)
    {
        try {
            $this->validateBookingRequest($request);
            $user = auth()->user();
            $model = new Appointment();
            $model->fill($request->all());
    
            if ($user) {
                $model->user_id = $user->id;
            }
    
            $model->save();
           
            return response()->json(['message' => 'Đã tạo cuộc hẹn thành công'], 201);
        } catch (QueryException $e) {
            // dd($e->getMessage());
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
