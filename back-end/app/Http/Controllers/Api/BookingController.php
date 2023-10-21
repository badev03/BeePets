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
use App\Interfaces\MessageUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;


class BookingController extends Controller
{
    protected $doctorController;

    public function __construct(DoctorController $doctorController)
    {
        $this->doctorController = $doctorController;
    }

    // lấy ra tên vaz tất cả dịch vụ và các bác sĩ làm được dịch vụ đó
    public function services()
    {
        $data = Service::select('id', 'name', 'price')
            ->with(['doctors:id,name'])
            ->get()
            ->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'price' => $service->price,
                    'doctors' => $service->doctors->map(function ($doctor) {
                        return [
                            'id' => $doctor->id,
                            'name' => $doctor->name,
                        ];
                    }),
                ];
            });
            if($data->isEmpty()){
                return response()->json(['message' => 'Không có dịch vụ nào'], 400);
            }
        return response()->json(['message' => 'Lấy danh sách dịch vụ thành công', 'data' => $data], 200);
    }


    public function doctorService(Request $request)
    {
        $doctor_id = $request->input('doctor_id');
        $service = Doctor::select('id', 'name', 'slug')->with(['services:id,name,price,slug'])->where('id', $doctor_id)->get();
        $service = $service->map(function ($doctor) {
            $doctor->services->map(function ($service) {
                $service->makeHidden('pivot'); // Loại bỏ các trường pivot
                return $service;
            });
            return $doctor;
        });
    
    
            if($service->isEmpty()){
                return response()->json(['message' => 'Không có dịch vụ nào'], 400);
            }
        return response()->json(['message' => 'Lấy danh sách dịch vụ thành công', 'data' => $service], 200);
    }

    public function typePets()
    {
        $data = Type_pet::select('id', 'name')->get();
        if($data->isEmpty()){
            return response()->json(['message' => 'Không có loại thú cưng nào'], 400);
        }
        return response()->json(['message' => 'Lấy danh sách loại thú cưng thành công', 'data' => $data], 200);
    }

    public function doctors(Request $request)
    {
        // validate doctors request và date
        $this->validate($request, [
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date_format:Y-m-d',
        ], [
            'required' => ':attribute không được để trống',
            'exists' => ':attribute không tồn tại',
            'date_format' => ':attribute không đúng định dạng',
        ]);
        
        $doctor = $request->input('doctor_id');
        $date = $request->input('date');
        // lấy ra lịch làm việc của bác sĩ theo ngày
        $work_schedule = Work_schedule::where('doctor_id', $doctor)->where('date', $date)->get();
        if ($work_schedule->isEmpty()) {
            return response()->json(['message' => 'Không có lịch làm việc của bác sĩ này'], 400);
        } else {
            return response()->json(['message' => 'Lấy danh sách lịch làm việc thành công', 'data' => $work_schedule], 200);
        }
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
    public function inforMember()
    {

        if (auth()->check()) {
            // lấy ra id tên va số điện thoại của khách hàng đang đăng nhập
            $user = auth()->user();
            $data = User::where('id', $user->id)->select('id', 'name', 'phone')->first();
            return response()->json(['message' => 'Lấy thông tin thành công', 'user' => $data], 200);
        }
        return response()->json(['message' => 'Bạn chưa đăng nhập'], 400);
    }


    // lưu dữ liệu đã chọn vào bảng appointment
    public function save(Request $request,MessageUser $messageInterface)
    {
        try {
            
            $validator = $this->validateBookingRequest($request);
    
         
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
          
        //    event(new \App\Events\MessageSendNotification($user_id,'bạn đã đặt lịch hẹn của thành công vui lòng chờ xác nhận của bác sĩ', $request->doctor_id, 'Có lịch hẹn mới'));
            $messageInterface->sendMessage($user_id,'Vui lòng chờ xác nhận của bác sĩ', $request->doctor_id, 'Có cuộc hẹn mới từ khách hàng');

            
            return response()->json(['message' => $request->all()], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // dd($e->getMessage());
            $errors = $e->validator->errors();
            return response()->json(['errors' => $errors], 500);
        }
    }


    private function validateBookingRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date_format:Y-m-d',
            'shift_name' => 'required',
            'type_pet_id' => 'required|exists:type_pets,id',
            'service_id' => 'required|exists:services,id',
        ], [
            'required' => ':attribute không được để trống',
            'exists' => ':attribute không tồn tại',
            'date_format' => ':attribute không đúng định dạng',
        ]);
    
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
    
        return $validator;
    }


    // lấy ra danh sách các cuộc hẹn có status = 0
    public function getAppointmentByStatus()
    {
        $doctor = auth()->user();
        $data = Appointment::where('doctor_id', $doctor->id)->where('status', 0)->with('user:id,name,phone')->with('service:id,name')->with('type_pet:id,name')->get();
        if ($data->isEmpty()) {
            return response()->json(['message' => 'Không có cuộc hẹn nào'], 400);
        } else {
            return response()->json(['message' => 'Lấy danh sách cuộc hẹn thành công', 'data' => $data], 200);
        }
    }
    // lấy ra thông tin của một cuộc hẹn với satus = 0
    public function getAppointment($id)
    {
        $data = Appointment::where('id', $id)->where('status', 0)->with('user:id,name,phone')->with('service:id,name')->with('type_pet:id,name')->get();
     
        if ($data->isEmpty()) {
            return response()->json(['message' => 'Không có cuộc hẹn nào'], 400);
        } else {
            return response()->json(['message' => 'Lấy danh sách cuộc hẹn thành công', 'data' => $data], 200);
        }
    }
   

    public function getAppointmentAccept()
    {
        $doctor = auth()->user();
        $data = Appointment::where('doctor_id', $doctor->id)->where('status', 1)->with('user:id,name,phone')->with('service:id,name')->with('type_pet:id,name')->get();
        if ($data->isEmpty()) {
            return response()->json(['message' => 'Không có cuộc hẹn nào'], 400);
        } else {
            return response()->json(['message' => 'Lấy danh sách cuộc hẹn thành công', 'data' => $data], 200);
        }
    }


    public function updateStatus(Request $request ,$id,MessageUser $messageInterface){
  
        if(Auth::guard('doctors')->check()){
            $doctor = auth()->user();
            $appointment = Appointment::where('id', $id)->where('doctor_id', $doctor->id)->first();
            
            if(!$appointment){
                return response()->json(['message' => 'Không có cuộc hẹn này'], 400);
            }
            // lấy ra giá tiền của dịch vụ trong lịch hẹn đó
            $service_price = Service::where('id', $appointment->service_id)->select('price')->first();
        //    chuyển dạng int sang float của service_price
            $service_price = floatval($service_price->price);
            $appointment->status = $request->input('status');
            $appointment->save();
            $messageInterface->sendMessage($appointment->user_id,'bác sĩ đã xác nhận cuộc hẹn của bạn', $doctor->id, 'Có cuộc hẹn mới');
            $bill = $this->doctorController->createBill($appointment->id, $doctor->id, $appointment->user_id,$appointment->service_id,$service_price);
            return response()->json(['message' => 'Cập nhật trạng thái thành công'
            ,'bill'=>$bill], 200);
        }else{
            return response()->json(['message' => 'Bạn chưa đăng nhập'], 400);
        }
    
    }
    
}