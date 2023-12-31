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
use Twilio\Rest\Client;


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
        ->where('status', 1)
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
        if ($data->isEmpty()) {
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


        if ($service->isEmpty()) {
            return response()->json(['message' => 'Không có dịch vụ nào'], 400);
        }
        return response()->json(['message' => 'Lấy danh sách dịch vụ thành công', 'data' => $service], 200);
    }

    public function typePets()
    {
        $data = Type_pet::select('id', 'name')->get();
        if ($data->isEmpty()) {
            return response()->json(['message' => 'Không có loại thú cưng nào'], 400);
        }
        return response()->json(['message' => 'Lấy danh sách loại thú cưng thành công', 'data' => $data], 200);
    }

    ublic function doctors(Request $request)
    {
        try {
            $this->validate($request, [
                'doctor_id' => 'required|exists:doctors,id',
                'date' => 'required|date_format:Y-m-d',
            ], [
                'required' => ':attribute không được để trống',
                'exists' => ':attribute không tồn tại',
                'date_format' => ':attribute không đúng định dạng',
            ]);
    
            $maxAppointments = 3;
            $doctor = $request->input('doctor_id');
            $date = $request->input('date');
            $now = Carbon::now();
    
            // Lấy danh sách lịch làm việc của bác sĩ trong ngày
            $work_schedule = Work_schedule::where('doctor_id', $doctor)
                ->whereDate('date', '>=', $now->toDateString())
                ->where(function ($query) use ($now) {
                    $query->whereDate('date', '>', $now->toDateString())
                        ->orWhere(function ($q) use ($now) {
                            $q->whereDate('date', $now->toDateString())
                                ->where('end_time', '>', $now->toTimeString());
                        });
                })
                ->get();
    
            if ($work_schedule->isEmpty()) {
                return response()->json(['message' => 'Không có lịch làm việc của bác sĩ này'], 200);
            }
    
            // Lấy số lượng cuộc hẹn của bác sĩ trong ngày
            $appointmentsCount = Appointment::where('doctor_id', $doctor)
                ->whereDate('date', $date)
                ->count();
            if ($appointmentsCount >= $maxAppointments) {
                return response()->json(['message' => 'Số lượng lịch hẹn đã đủ', 'data' => []], 200);

            } else {
                return response()->json(['message' => 'Lấy danh sách lịch làm việc thành công', 'data' => $work_schedule], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }



    // lấy ra lịch làm việc của bác sĩ theo ngày
    public function workSchedule(Request $request)
    {
        $doctor_id = $request->input('doctor_id');
        $date = $request->input('date');
        $work_schedule = Work_schedule::where('doctor_id', $doctor_id)->where('date', $date)->get();
        if ($work_schedule->isEmpty()) {
            return response()->json(['message' => 'Không có lịch làm việc của bác sĩ này', []], 200);
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
    public function save(Request $request, MessageUser $messageInterface)
    {
        try {

            $validator = $this->validateBookingRequest($request);

            $name = $request->input('name');
            $phone = $request->input('phone');
            $model = new Appointment();
            // dd($request->all());
            if (User::where('phone', $phone)->exists()) {
                $user = User::where('phone', $phone)->first();
                $user_id = $user->id;

                if ($user->name != $name) {
                    $model->fill(array_merge($request->all(), [
                        'user_id' => $user_id,
                        'status' => 0,
                        'customer_name' => $name,

                    ]));
                } else {
                    $model->fill(array_merge($request->all(), [
                        'user_id' => $user_id,
                        'status' => 0,
                    ]));
                }
                $model->save();
            } else {
                $user = new User();
                $user->name = $name;
                $user->phone = $phone;
                $user->password = bcrypt('123456');
                $user->status = 1;
                $user->role_id = 4;
                $user->save();
                $user_id = $user->id;

                $model->fill(array_merge($request->all(), [
                    'user_id' => $user_id,
                    'status' => 0,
                ]));
                $model->save();
            }




            $messageInterface->sendMessage($user_id, 'Vui lòng chờ xác nhận của bác sĩ', $request->doctor_id, 'Có cuộc hẹn mới cần xác nhận ', $model->id);


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
        $currentDate = now();

        $data = Appointment::where('doctor_id', $doctor->id)
            ->where('status', 0)
            ->whereDate('date', '>=', $currentDate) // Lọc lịch hẹn từ ngày hiện tại trở đi
            // ->whereHas('work_schedule', function ($query) use ($currentDate) {
            //     $query->where('end_time', '>', $currentDate);
            // })
            ->with('user:id,name,phone,avatar')
            ->with('service:id,name')
            ->with('type_pet:id,name')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'Không có cuộc hẹn nào'], 400);
        } else {
            return response()->json(['message' => 'Lấy danh sách cuộc hẹn thành công', 'data' => $data], 200);
        }
    }

    // lấy ra thông tin của một cuộc hẹn với satus = 0
    public function getAppointment($id)
    {
        $data = Appointment::where('id', $id)
            ->where('status', 0)
            ->with('user:id,name,phone')
            ->with('service:id,name')
            ->with('type_pet:id,name')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'Không có cuộc hẹn nào'], 400);
        } else {
            return response()->json(['message' => 'Lấy danh sách cuộc hẹn thành công', 'data' => $data], 200);
        }
    }


    public function getAppointmentAccept()
    {
        $currentDate = now();
        $doctor = auth()->user();

        $data = Appointment::where('doctor_id', $doctor->id)
            ->where(function ($query) use ($currentDate) {
                $query->where(function ($query) use ($currentDate) {
                    $query->where('status', 1)
                        ->whereDate('date', '>=', $currentDate); // Lọc lịch hẹn từ ngày hiện tại trở đi
                    // ->whereHas('work_schedule', function ($query) use ($currentDate) {
                    //     $query->where('end_time', '>', $currentDate);
                    // });
                })->orWhereNotIn('status', [0, 1]);
            })
            ->with('user:id,name,phone,avatar')
            ->with('service:id,name')
            ->with('type_pet:id,name')
            ->with('bill:id,appointment_id') // Load thông tin của Bills từ Appointment
            ->orderBy('created_at', 'desc')
            ->get();
        if ($data->isEmpty()) {
            return response()->json(['message' => 'Không có cuộc hẹn nào'], 400);
        } else {
            return response()->json(['message' => 'Lấy danh sách cuộc hẹn thành công', 'data' => $data], 200);
        }
    }







    public function updateStatus(Request $request, $id, MessageUser $messageInterface)
    {

        if (Auth::guard('doctors')->check()) {
            $doctor = auth()->user();
            $appointment = Appointment::where('id', $id)->where('doctor_id', $doctor->id)->first();

            if (!$appointment) {
                return response()->json(['message' => 'Không có cuộc hẹn này'], 400);
            }
            // lấy ra giá tiền của dịch vụ trong lịch hẹn đó
            $service_price = Service::where('id', $appointment->service_id)->select('price')->first();
            //    chuyển dạng int sang float của service_price
            $service_price = floatval($service_price->price);
            $appointment->status = $request->input('status');
            if ($request->status == 1) {
                //lay so thu tu

                $existingAppointments = Appointment::where('status','!=',0)->where('date', $appointment->date)->orderBy('created_at')->count();
                // dd($existingAppointments);
       
                if ($existingAppointments == 0) {
                    $appointment->stt = 1;
                } else {
                    $appointment->stt = $existingAppointments + 1;
                }

              
           

                $appointment->save();
                $bill = $this->doctorController->createBill($appointment->id, $doctor->id, $appointment->user_id, $service_price);
                $messageInterface->sendMessage($appointment->user_id, 'Bác sĩ ' . $doctor->name . '  đã xác nhận cuộc hẹn của bạn', $doctor->id, 'Bạn đã xác nhận thành công cuộc hẹn của khách hàng ' . $appointment->user->name, $appointment->id);
                $user = User::where('id', $appointment->user_id)->first();
                $phone = $user->phone;
                if ($phone == '0981324706') {
                    $phone = ltrim($phone, '0');
                    $phone = '+84' . $phone;
                    $sid = getenv("TWILIO_SID");
                    $token = getenv("TWILIO_TOKEN");
                    $number = getenv("TWILIO_FROM");
                    $twilio = new Client($sid, $token);
                    $message = $twilio->messages
                        ->create(
                            $phone, // to
                            array(
                                "from" => $number,
                                "body" => "Bác sĩ " . $doctor->name . " đã xác nhận cuộc hẹn của bạn vào lúc " . $appointment->date . " " . $appointment->shift_name . " tại phòng khám thú y BeePets. Vui lòng đến đúng giờ. Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi."
                            )
                        );
                    if ($message->sid) {
                        return response()->json([
                            'message' => 'Cập nhật trạng thái thành công', 'bill' => $bill
                        ], 200);
                    }
                }
            }
            if ($request->status == 6) {
                $reasonCancel = $request->input('reason_cancel');
                if (!$reasonCancel) {
                    return response()->json(['message' => 'Bạn chưa nhập lý do hủy cuộc hẹn'], 400);
                }
                $appointment->reason_cancel = $reasonCancel;
                $appointment->status = 6;
                $appointment->save();
                $messageInterface->sendDoctorToAdmin($doctor->id, 'bạn đã gửi yêu cầu hủy lịch hẹn của khách hàng' . $appointment->user->name, 1, 'bác sĩ ' . $doctor->name . ' đã gửi yêu cầu hủy lịch hẹn của khách hàng ' . $appointment->user->name, $appointment->id);
                return response()->json(['message' => 'Bạn đã hủy cuộc hẹn'], 200);
            }
            if ($request->status == 4) {
                $appointment->status = 4;
                $appointment->save();
                $messageInterface->sendMessage($appointment->user_id, 'Cuộc hẹn của bạn đã hoàn thành', $doctor->id, 'Cuộc hẹn của' . $appointment->user->name . ' đã hoàn thành', $appointment->id);
                return response()->json(['message' => 'Bạn đã hoàn thành cuộc hẹn'], 200);
            }
            if ($request->status == 7) {
                $reasonChange = $request->input('reason_change');

                if (!$reasonChange) {
                    return response()->json(['message' => 'Bạn chưa nhập lý do đổi cuộc hẹn'], 400);
                }
                $appointment->reason_change = $reasonChange;
                $appointment->status = 7;
                $appointment->save();
                $messageInterface->sendDoctorToAdmin($doctor->id, 'bạn đã gửi yêu cầu đổi lịch hẹn của khách hàng' . $appointment->user->name, 1, 'bác sĩ ' . $doctor->name . ' đã gửi yêu cầu đổi lịch hẹn của khách hàng ' . $appointment->user->name, $appointment->id);
                return response()->json(['message' => 'Bạn đã yêu cầu đổi cuộc hẹn'], 200);
            }
            return response()->json([
                'message' => 'Cập nhật trạng thái thành công', 'bill' => $bill
            ], 200);
        } else {
            return response()->json(['message' => 'Bạn chưa đăng nhập'], 400);
        }
    }
}
