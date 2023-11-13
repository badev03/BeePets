<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppointmentRequest;
use App\Interfaces\MessageUser;
use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Bill_service;
use App\Models\Doctor;
use App\Models\Order_detail;
use App\Models\Products;
use App\Models\Service;
use App\Models\Type_pet;
use App\Models\User;
use App\Traits\QueryCommon;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Vonage\Voice\Endpoint\App;
use function Laravel\Prompts\select;

class AppointmentController extends Controller
{
    use QueryCommon;
    public $model = Appointment::class;
    public $urlbase = 'appointment.';
    public $pathView = 'admin.appointments.';
    public $title = 'Cuộc hẹn';
    protected $permissionCheckCrud = 'appointment';
    public $listIndex = ['Doctor' , 'User' , 'TypePet' , 'Service'];
    protected $FIELD_SELECT_CUSTOM_CONTROLLER= ['doctor_id' , 'user_id','type_pet_id' , 'service_id' ];
    public $colums = [];
    protected $special = ['start_time' , 'end_time'];

    public function index()
    {
        $data = $this->QuerySpecialIndex()
            ->whereIn('appointments.status' , [1 , 6])
            ->get();;
        $dataDoctor = $this->tableSelect('doctors')->get();
        $dataService = $this->tableSelect('services')->get();
        $dataTypePet = $this->tableSelect('type_pets')->get();
        $permission_crud = $this->permissionCheckCrud;
        return view($this->pathView.'index' , compact('data' , 'permission_crud'
            , 'dataService' , 'dataTypePet' , 'dataDoctor'))
            ->with([
                'colums' => $this->columns('index'),
                'urlbase' => $this->urlbase,
                'title_web' => $this->title,
                'title' => $this->title,
            ]);
    }

    public function QuerySpecialIndex()
    {
        $appointments = $this->queryCommon()
            ->orderByDesc('id')
            ->whereNull('appointments.deleted_at')
            ->orderBy('id', 'DESC')
            ->addSelect('w.start_time' , 'w.end_time')
            ->addSelect('appointments.status')
            ->join('work_schedules as w', function ($join) {
                $join->on('appointments.date', '=', 'w.date')
                    ->on('appointments.doctor_id', '=', 'w.doctor_id')
                    ->on('appointments.shift_name', '=', 'w.shift_name');
            });
        return $appointments;
    }

    public function WaitForConfirmation() {
        $data = $this->QuerySpecialIndex()->whereIn('appointments.status' , [0])->get();
        $dataDoctor = $this->tableSelect('doctors')->get();
        $dataService = $this->tableSelect('services')->get();
        $dataTypePet = $this->tableSelect('type_pets')->get();
        $permission_crud = $this->permissionCheckCrud;
        return view($this->pathView.'wait-for-confirmation' , compact('data' , 'permission_crud'
            , 'dataService' , 'dataTypePet' , 'dataDoctor'))
            ->with([
                'colums' => $this->columns('index'),
                'urlbase' => $this->urlbase,
                'title_web' => $this->title,
                'title' => $this->title,
            ]);
    }

    public function ForHistoryAppointment() {
        $data = $this->QuerySpecialIndex()->whereIn('appointments.status' , [4 , 3])->get();
        $dataDoctor = $this->tableSelect('doctors')->get();
        $dataService = $this->tableSelect('services')->get();
        $dataTypePet = $this->tableSelect('type_pets')->get();
        $permission_crud = $this->permissionCheckCrud;
        return view($this->pathView .'history-appointments'  , compact('data' , 'permission_crud'
            , 'dataService' , 'dataTypePet' , 'dataDoctor'))
            ->with([
                'colums' => $this->columns('index'),
                'urlbase' => $this->urlbase,
                'title_web' => $this->title,
                'title' => $this->title,
            ]);
    }

    public function ForConfirmationFinished($id) {
        $this->findID($id , 4);
        return back()->with(['success_delete' => 'Đã xác nhận hoàn thành lịch hẹn này ']);
    }

    public function findID($id , $status) {
        $model = Appointment::find($id)->update(['status' => $status]);
        return $model;
    }
    public function ForConfirmation($id , MessageUser $message) {
        $this->findID($id , 1);
        $appointments = Appointment::find($id);
        $this->createBill($appointments->id , $appointments->doctor_id , $appointments->user_id
            , 0);
        $message->sendMessageNew($appointments->user_id , 'Đã xác nhận thành công'
            , $appointments->doctor_id , 'Đã xác nhận thành công cho khách hàng' , $appointments->id);
        return back()->with(['success_delete' => 'Đã xác nhận lịch hẹn này ']);
    }

    public function createBill($appointmentId, $doctorId, $userId, $service_price)
    {
        $code = 'HĐ' . rand(100000, 999999);
        $bill = new Bill();
        $bill->code = $code;
        $bill->appointment_id = $appointmentId;
        $bill->doctor_id = $doctorId;
        $bill->user_id = $userId;
        $bill->status = 0;
        $bill->payment_method = 1;
        $bill->total_amount = $service_price;
        $bill->save();
        return $bill;
    }


    public function FinishedConfirmation($id) {
        $this->findID($id , 3);
        return back()->with(['success_delete' => 'Đã xác nhận lịch hẹn này ']);
    }

    public function tableSelect($table) {
        $query = DB::table($table)->select('id' , 'name');
        return $query;
    }

    public function create() {
        return view(admin_403);
    }

    public function store(AppointmentRequest $request , MessageUser $messageUser)
    {
        $data = $this->dataAppointent();
        $checkShift = $this->tableQuery('appointments')
            ->where('user_id' , '=' , $request->user_id)
            ->where('date' , '=' , $request->date)
            ->where('shift_name' , '=' , $request->shift_name)
            ->first();
        if($checkShift) {
            return back()->with('error', 'Xin lỗi lịch đặt của bạn đã bị trùng với lịch bạn đặt trước đó');
        }
        $checkPhone = $this->checkPhoneAppointments($request->user_id);
        $id_appointments = '';
        if($checkPhone) {
            $data['user_id'] = $checkPhone->id;
            $id_appointments = $this->tableQuery('appointments')->insertGetId(array_merge($request->except('_token' , 'user_id') , $data));
            $messageUser->sendMessage($checkPhone->id, 'Chào '.$checkPhone->name.'Chúng tôi đã tạo thành công lịch khám cho bạn' , $request->doctor_id , 'UserName :'.$checkPhone->name.'đã đạt lịch của bạn' , $id_appointments);
            if($request->status == 1) {
                $this->createBill($id_appointments, $request->doctor_id , $data['user_id']
                    , 0);
            }
            return back()->with('success', 'Thao tác thành công');
        }
        else {
            $data['user_id'] = $this->createUserAuto($request->user_id);
            $checkPhone = $this->checkIdAppointment($request->user_id);
            $id_appointments = $this->tableQuery('appointments')->insertGetId(array_merge($request->except('_token') , $data));
            $messageUser->sendMessage($data['user_id'], 'Chào '.$checkPhone->name.'Chúng tôi đã tạo thành công lịch khám cho bạn' , 'UserName :'.$checkPhone->name.'đã đạt lịch của bạn' , $id_appointments);
            if($request->status == 1) {
                $this->createBill($id_appointments, $request->doctor_id , $data['user_id']
                    ,  0);
            }
            return back()->with('success', 'Thao tác thành công');
        }
    }

    public function edit(string $id)
    {
        $this->columns('edit');
        $model = $this->queryCommon()
            ->where('appointments.id' , $id)
            ->first();
        $user = $this->tableQuery('users')
            ->where('id' , '=' , $model->id_user)
            ->first();
        $getDayDefault = $this->tableQuery('work_schedules')
            ->where('doctor_id' , '=' , $model->id_doctor)
            ->where('date' , '=' , $model->date)
            ->get();
        $dataDoctor = $this->tableSelect('doctors')->get();
        $dataService = $this->tableSelect('services')->get();
        $dataTypePet = $this->tableSelect('type_pets')->get();
        $time_set_up_shift = ['09:00:00-11:00:00' , '11:00:00-13:00:00' , '13:00:00-15:00:00'];
        return view($this->pathView.__FUNCTION__ ,
            compact('model' , 'user' ,
                'getDayDefault' , 'dataDoctor' , 'dataService' , 'dataTypePet' , 'time_set_up_shift'))
            ->with([
                'title_web'=>$this->title,
                'title' => $this->title,
                'urlbase'=>$this->urlbase,
                'colums' => $this->columns('edit')
            ]);

    }

    public function update(Request $request, string $id , MessageUser $messageUser)
    {
        $phone = $request->user_id;
        if($phone) {
            $checkPhone = $this->checkPhoneAppointments($phone);
            if($checkPhone) {
                $data = [
                    'time' =>now(),
                    'updated_at' => $this->getTimestampQuery(),
                ];
                $this->tableQuery('appointments')
                    ->where('id' , '=' , $id)
                    ->update(array_merge($request->except(['_token' , '_method' , 'user_id']) , $data));
                $messageUser->sendMessageNew($checkPhone->id, 'Chào '.$checkPhone->name.'Chúng tôi đã update thành công lịch khám cho bạn' , $request->doctor_id , 'UserName :'.$checkPhone->name.'đã update lại đạt lịch của bạn' ,$id );
                return back()->with('success', 'Thao tác thành công');
            }
            else {
                $id_user = $this->createUserAuto($phone);
                $data = [
                    'description' => $request->description,
                    'date' => $request->date,
                    'type_pet_id' => $request->type_pet_id,
                    'service_id' => $request->service_id,
                    'doctor_id' => $request->doctor_id,
                    'user_id' => $id_user,
                    'time' =>now(),
                    'created_at' => $this->getTimestampQuery(),
                    'updated_at' => $this->getTimestampQuery(),
                ];
                $this->tableQuery('appointments')
                    ->where('id' , '=' , $id)
                    ->update($data);
                $messageUser->sendMessageNew($checkPhone->id, 'Chào '.$checkPhone->name.'Chúng tôi đã update thành công lịch khám cho bạn' , $request->doctor_id , 'UserName :'.$checkPhone->name.'đã update lại đạt lịch của bạn' , $id);
                return back()->with('success', 'Thao tác thành công');
            }
        }
    }

    public function getDay($day , $id){
        $time_work_shift = DB::table('work_schedules')
            ->where('doctor_id' , '=' , $id)
            ->where('date' , '=' ,$day)->get();
        return response()->json([
            'time_work_shift' => $time_work_shift
        ] , '200');
    }

    public function FilterDate($data , $status) {
        $day_appointments = $this->QueryFilter()->where('appointments.date' , '=' , $data)
            ->where('appointments.status' , $status)
            ->get();
        return response()->json(['day_appointments'=> $day_appointments] , '200');
    }

    public function QueryFilter () {
        $query = DB::table('appointments')
            ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->join('type_pets', 'type_pets.id', '=', 'appointments.type_pet_id')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->select('appointments.description' , 'doctors.name as doctor_id' , 'users.name as user_id',
                'type_pets.name as type_pet_id' , 'services.name as service_id' , 'appointments.id',
                'appointments.doctor_id as id_doctor'  , 'appointments.date'
            )
            ->addSelect('w.start_time' , 'w.end_time')
            ->addSelect('appointments.status')
            ->join('work_schedules as w', function ($join) {
                $join->on('appointments.date', '=', 'w.date')
                    ->on('appointments.doctor_id', '=', 'w.doctor_id')
                    ->on('appointments.shift_name', '=', 'w.shift_name');
            });
        return $query;
    }

    public function FilterSearch(Request $request) {
        $searchTerm = $request->input('searchTerm');
        $searchName = $this->QueryFilter()
            ->where('users.name' , 'like' , '%'.$searchTerm.'%')
            ->where('appointments.status' , $request->status)
            ->get();
        return response()->json([
            'searchUser' => $searchName
        ] , '200');
    }

    public function FilterTime($data , $status) {
        $time_appointments = $this->QueryFilter()->where('appointments.shift_name' , '=' , $data)
            ->where('appointments.status' , $status)
            ->get();
        return response()->json(['time_appointments'=> $time_appointments] , '200');
    }

    public function FilterSearchPhone(Request $request) {
        $searchPhone = $request->input('searchPhones');
        $resultPhone = $this->tableQuery('users')
            ->where('users.phone' , '=' , $searchPhone)
            ->where('users.role_id' , '=' , 4)
            ->get();
        return response()->json([
            'searchUser' => $resultPhone
        ] , '200');
    }

    public function createData($id) {
        $user = $this->tableQuery('users')->where('role_id' , '=' , 4)
            ->where('id' , '=' , $id)
            ->first();
        $timeWork = $this->tableQuery('work_schedules')
            ->where('doctor_id' , '=' , 1)
            ->where('date' , '=' , date('Y-m-d'))
            ->get();
        $checkTime = $this->tableQuery('appointments')->where('date' , '=' , date('Y-m-d'))
            ->where('doctor_id' , '=' , 1)
            ->select('time')
            ->get();
        $timeCompare = [];
        foreach ($checkTime as $keyCheckTime=>$valueCheckTime) {
            $timeCompare[] = $valueCheckTime->time;
        }
        $outputArray = [];

        foreach ($timeCompare as $time) {
            $outputArray[] = substr($time, 0, 5);
        }

        $dataDoctor = $this->tableSelect('doctors')->get();
        $dataService = $this->tableSelect('services')->get();
        $dataTypePet = $this->tableSelect('type_pets')->get();
        $dataTime = [];

        foreach ($timeWork as $key => $item) {
            $startTime = \Carbon\Carbon::parse($item->slot_time);
            $endTime = \Carbon\Carbon::parse($item->end_time);

            $timeSlots = [];

            while ($startTime <= $endTime) {
                $timeSlots[] = $startTime->format('H:i');
                $startTime->addHour();
            }

            $dataTime[] = $timeSlots;
        }

        $mergedArray = [];
        $mergedArray = array_merge(...$dataTime);

        $this->colums = [
            'doctor_id' => 'Tên bác sĩ',
            'type_pet_id' => 'Loại thứ cưng',
            'service_id' => 'Tên dịch vụ',
            'description' => 'Mô tả',
        ];
        $dayDefault = date('Y-m-d');
        $getTimeShift = $this->tableQuery('work_schedules')
            ->where('date' , '=' , $dayDefault)
            ->where('doctor_id' , '=' , 5 )
            ->get();
        $dataViewer = [
            'colums' => $this->colums,
            'urlbase' => $this->urlbase,
            'title_web' => $this->title,
            'title' => $this->title,
            'dataDoctor' => $dataDoctor,
            'dataService' => $dataService,
            'timeWork' => $timeWork,
            'dataTypePet' => $dataTypePet,
            'data_time_appointments' => $mergedArray,
            'timeCompare' => $outputArray,
            'getDayDefault' => $getTimeShift
        ];

        return view($this->pathView.'create' , compact('user'))
            ->with($dataViewer);
    }

    public function getDoctor($id) {
        $checkService = $this->tableQuery('doctor_service')
            ->select('doctors.name' , 'doctors.id')
            ->join('services' , 'services.id' , '=' , 'doctor_service.service_id')
            ->join('doctors' , 'doctors.id' , '=' , 'doctor_service.doctor_id')
            ->join('service_categories' , 'service_categories.id' , '=' , 'services.service_categorie_id')
            ->where('service_categories.status' , '=' , 1)
            ->where('doctor_service.service_id' ,$id )
            ->groupBy('doctors.name' , 'doctors.id')
            ->get();
        if($checkService) {
            return response()->json([
                'msg' => 'có dữ liệu',
                'doctor' => $checkService,
            ] , 200);
        }
        else {
            return response()->json([
                'msg' => 'Không có bác sĩ',
            ] , 400);
        }
    }

    public function getShiftDoctor($id , $day) {
        $checkTime = $this->tableQuery('work_schedules')->where('date' , '=' , $day)
            ->where('doctor_id' , '=' , $id)
            ->get();
        if($checkTime) {
            return response()->json([
                'msg' => 'có dữ liệu',
                'shift_appointment' => $checkTime,
            ] , 200);
        }
        else {
            return response()->json([
                'msg' => 'Không có bác sĩ',
            ] , 400);
        }
    }

    public function FilterService($data , $status) {
        $service = $this->QueryFilter()
            ->where('appointments.service_id' , '=' , $data)
            ->where('appointments.status' , $status)
            ->get();
        return response()->json(['service'=> $service] , '200');
    }

    public function FilterDoctor($data , $status) {
        $doctor = $this->QueryFilter()
            ->where('appointments.doctor_id' , '=' , $data)
            ->where('appointments.status' , $status)
            ->get();
        return response()->json(['doctor'=> $doctor] , '200');
    }

    public function TrashCan() {
        $appointments = $this->queryCommon()
            ->whereNotNull('appointments.deleted_at')
            ->where('appointments.status' , 4)
            ->orderByDesc('id')
            ->get();
        $appointments->each(function ($appointment) {
            $time_schedule = $this->tableQuery('work_schedules')
                ->where('date', $appointment->date)
                ->where('doctor_id', $appointment->id_doctor)
                ->where('shift_name', $appointment->shift_name)
                ->get();
            $appointment->start_time = str_replace('"', '', trim($time_schedule->pluck('start_time'), '[]'));
            $appointment->end_time = str_replace('"', '', trim($time_schedule->pluck('end_time'), '[]'));
        });

        $dataViewer = [
            'urlbase' => $this->urlbase,
            'title_web' => $this->title,
            'FIELD_SELECT_CUSTOM_CONTROLLER' => $this->FIELD_SELECT_CUSTOM_CONTROLLER,
            'special', $this->special,
            'title' => $this->title,
        ];
        return view($this->pathView.'trash-can' , compact('appointments'))->with($dataViewer);
    }

    public function RestoreTrash(MessageUser $messageService ,string $id) {
        $appointment = Appointment::withTrashed()->find($id);
        if($appointment) {
            $appointment->restore();
            $messageService->sendAdmin($id , 'bạn vừa không phục cuộc hẹn của khách hàng :' .$appointment->id
                , 'Cuôc hẹn đã khôi phục thành công' , $appointment->user_id);
//            $messageService->sendMessageNew($appointment->user_id, 'ok la nhé', $appointment->doctor_id, 'Ok ã khôi phục thành công' , $id);
//            event(new \App\Events\MessageSendNotification($appointment->user_id, 'Đã khôi phục thành công hihah ok la', $appointment->doctor_id, 'Ok ã khôi phục thành công'));
            return back()->with(['success_delete' => 'Đã khôi phục dữ liệu thành công']);
        }
        return back()->with(['failed_delete' => 'Dữ liệu khôi phục không hợp lệ']);
    }

    public function destroy(MessageUser $messageUser , string $id) {
        if (auth()->user()->can(['delete-appointment'])) {
            $model = Appointment::findOrFail($id);
            $userName = User::find($model->user_id);
            $model->update(['status' => 3]);
            $model->delete();
            $messageUser->sendMessageNew($model->user_id, 'Chào '.$userName->name.
                'Chúng tôi đã hủy lịch hẹn của bạn' , $model->doctor_id , 'UserName :'.$userName->name.'đã đạt lịch của bạn' , $id);
            return back()->with('success_delete', 'Đã xóa thành công');
        }
        else {
            return view(admin_403);
        }
    }

    public function columns($case) {
        switch ($case) {
            case 'index' :
                $this->colums = [
                    'doctor_id' => 'Tên bác sĩ',
                    'user_id' => 'Bệnh nhân',
                    'type_pet_id' => 'Loại thứ cưng',
                    'service_id' => 'Tên dịch vụ',
                    'description' => 'Mô tả',
                ];
                break;
            case 'edit':
                $this->colums = [
                    'doctor_id' => 'Tên bác sĩ',
                    'type_pet_id' => 'Loại thứ cưng',
                    'service_id' => 'Tên dịch vụ',
                    'description' => 'Mô tả',
                ];
                break;
            default:
                break;
        }
        return $this->colums;
    }


    public function Statistics() {
        $range = Carbon::now()->startOfDay();
        $statistics = DB::table('appointments')
            ->select('status', DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', $range)
            ->groupBy('status')
            ->get();
        return view('admin.appointments.statistics' , compact('statistics'));
    }

    public function StatisticsDay($day) {
        if($day == -7 || $day==-14 || $day==-21) {
            $day = abs($day);
            $range = Carbon::now()->subDays($day);
        }
        else {
            $range = Carbon::now()->addDays($day);
        }
        $statistics = DB::table('appointments')
            ->select('status', DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', $range)
            ->groupBy('status')
            ->get();
        return response()->json(['filter' => $statistics]);
    }

    public function StatisticsDate($date) {
        $statistics = DB::table('appointments')
            ->select('status', DB::raw('COUNT(*) as count'))
            ->where('date', '=', $date)
            ->groupBy('status')
            ->get();
        return response()->json(['filter' => $statistics]);
    }

    public function AppointmentCancel($id) {
        $appointmentCancel = $this->queryCommon()
            ->where('appointments.status' , 6)
            ->where('appointments.id' , $id)
            ->join('notifications' , 'notifications.appointment_id' , '=' , 'appointments.id')
            ->addSelect('notifications.message_admin' , 'users.phone')
            ->first();
        if($appointmentCancel) {
            $dataDoctor = $this->tableSelect('doctors')->get();
            return view('admin.appointments.appointments-cancel-edit' ,
                compact('appointmentCancel' , 'dataDoctor'));
        }
        return view('admin.appointments.edit-change' )->with(['error'=>'Dữ liệu đã được thay đổi']);
    }

    public function ChangeDoctorAdmin(Request $request , $id) {
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'shift_name' => 'required',
        ] , [
            'doctor_id.required' => 'Truờng bác sĩ không được để trống',
            'shift_name.required' => 'Trường ca không được để trống'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'doctor_id' => $request->doctor_id,
            'status' => 5,
            'shift_name' => $request->shift_name,
            'time' =>now(),
            'created_at' => $this->getTimestampQuery(),
            'updated_at' => $this->getTimestampQuery(),
        ];
        $this->tableQuery('appointments')
            ->where('id' , '=' , $id)
            ->update($data);
        return back()->with(['success'=> 'Đã đổi lịch thành công']);
    }

    public function CancelDoctorAdmin($id , MessageUser $messageUser) {
        $model = Appointment::findOrFail($id);
        $userName = User::find($model->user_id);
        $model->update([
            'status' => 4
        ]);
        $model->delete();
        $messageUser->sendMessage($model->user_id, 'Chào '.$userName->name.
            'Chúng tôi đã hủy lịch hẹn của bạn' , $model->doctor_id , 'UserName :'.$userName->name.'đã đạt lịch của bạn');
        return back()->with('success', 'Đã xóa thành công');
    }

    public function AppointmentCancelRequirements() {
        $appointmentCancel = $this->queryCommon()
            ->where('appointments.status' , 6)
            ->join('notifications' , 'notifications.appointment_id' , '=' , 'appointments.id')
            ->addSelect('notifications.message_admin' , 'users.phone')
            ->get();
        if(!$appointmentCancel->isEmpty()) {
            return view($this->pathView.'appointments-cancel' , compact('appointmentCancel'));
        }
        else {
            return view($this->pathView.'appointments-cancel')->with([
                'error' => 'Không có dữ liệu'
            ]);
        }
    }

    public function billCommon($id) {
        $model = Bill::where('bills.appointment_id', $id)
            ->join('appointments', 'appointments.id', '=', 'bills.appointment_id')
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->join('doctors', 'bills.doctor_id', '=', 'doctors.id')
            ->select('bills.id', 'bills.code', 'bills.total_amount', 'bills.created_at','appointments.status',
                DB::raw('COALESCE(doctors.image, "n/a") as image_doctor'),
                DB::raw('COALESCE(doctors.name, "n/a") as doctor_name'),
                DB::raw('COALESCE(users.name, "n/a") as customer_name'),
                DB::raw('COALESCE(users.phone, "n/a") as customer_phone'),
                'appointments.date', 'appointments.time', 'appointments.shift_name', 'appointments.shift_name' ,
                DB::raw('COALESCE(users.address, "n/a") as customer_address'),
                DB::raw('COALESCE(services.name, "n/a") as service_name'),
                DB::raw('COALESCE(users.avatar, "n/a") as customer_avatar'));
        return $model;
    }

    public function detailBills ($id) {
        $products = Products::query()->get();
        $model = $this->billCommon($id)->first();
        $services = Service::query()->get();
        $services_bills = $this->tableQuery('bill_service')
            ->where('bill_id' , $model->id)
            ->get();
        $services_bills = $services_bills->pluck('service_id')->toArray();

        $products_prescription = $this->tableQuery('order_details')
            ->where('bill_id' , $model->id)
            ->get();
        $products_prescription = $products_prescription->pluck('product_id')->toArray();

        if (!$products_prescription) {
            $products_prescription = $this->tableQuery('prescriptions')
                ->join('prescription_product' ,'prescription_product.prescription_id' , '='
                    , 'prescriptions.id' )
                ->join('products' ,'products.id' , '='
                    , 'prescription_product.product_id' )
                ->select('prescription_product.product_id')
                ->where('prescriptions.bill_id' , $model->id)
                ->get();
            $products_prescription = $products_prescription->pluck('product_id')->toArray();
        }


        if(!$model) {
            $model = $this->billCommon($id)
                ->join('prescriptions', 'prescriptions.bill_id', '=', 'bills.id')
                ->addSelect(
                    DB::raw('COALESCE(prescriptions.name, "n/a") as prescriptions_name'),
                    DB::raw('COALESCE(prescriptions.price, "n/a") as prescriptions_price'),
                    DB::raw('COALESCE(services.name, "n/a") as service_name'),
                    'appointments.date', 'appointments.time', 'appointments.shift_name', 'appointments.shift_name' ,
                    DB::raw('COALESCE(appointments.description, "n/a") as description'),
                    'doctors.id as doctor_id', 'users.id as user_id')
                ->first();
            $services = Service::query()->get();
            $services = $services->filter(function ($service) use ($model) {
                return $service->name !== $model->service_name;
            });
        }

        $dataDoctor = $this->tableSelect('doctors')->get();
        $dataService = $this->tableSelect('services')->get();
        $dataTypePet = $this->tableSelect('type_pets')->get();
        $permission_crud = $this->permissionCheckCrud;
        return view($this->pathView.'detail-view' , compact('model' , 'permission_crud'
            , 'dataService' , 'dataTypePet' , 'dataDoctor'))
            ->with([
                'colums' => $this->columns('index'),
                'urlbase' => $this->urlbase,
                'title_web' => $this->title,
                'products' => $products,
                'services' => $services,
                'services_bills' => $services_bills,
                'products_prescription' => $products_prescription,
            ]);
    }


    public function billAppointmentAdd(Request $request, $id) {
        if ($request->service_id) {
            // Xóa tất cả các bản ghi hiện có trong bảng trung gian cho hóa đơn có id là $id
            DB::table('bill_service')->where('bill_id', $id)->delete();

            // Thêm mới dữ liệu từ request vào bảng trung gian
            foreach ($request->service_id as $key => $value) {
                DB::table('bill_service')->insert([
                    'bill_id' => $id,
                    'service_id' => $value,
                ]);
            }
        } else {
            // Nếu không có service_id nào được gửi, bạn có thể xóa tất cả các bản ghi hiện có trong bảng trung gian
            DB::table('bill_service')->where('bill_id', $id)->delete();
        }
        if($request->total_amount) {
            $this->tableQuery('bills')
                ->where('id' , $id)
                ->updateOrInsert([
                    'total_amount' => $request->total_amount,
                    'code' => $request->code,
                    'user_id' => $request->user_id,
                    'doctor_id' => $request->doctor_id,
                    'payment_method' => $request->payment_method,
                ]);

            foreach ($request->product_id as $key => $value) {
                $prices = Products::query()->find($value);
                Order_detail::query()->create(
                    [
                        'bill_id' => $id,
                        'product_id' => $value,
                        'quantity' => $request->quantity[$key],
                        'unit_price' => $prices->price,
                    ]
                );
                $this->updateQuantity($value, $request->quantity[$key]);
            }
        }

        return back()->with(['success' => 'Thao tác thành công']);
    }

    public function updateQuantity($id, $quantity)
    {
        $product = Products::query()->find($id);
        $product->quantity = $product->quantity - $quantity;
        $product->save();
    }

    public function BillsAppointments () {
        $products = Products::query()->get();
        $data = $this->queryCommon()
            ->join('bills' , 'bills.appointment_id' , '=' , 'appointments.id')
            ->join('work_schedules as w', function ($join) {
                $join->on('appointments.date', '=', 'w.date')
                    ->on('appointments.doctor_id', '=', 'w.doctor_id')
                    ->on('appointments.shift_name', '=', 'w.shift_name');
            })
            ->addSelect('w.start_time' , 'w.end_time')
            ->addSelect('appointments.status')
            ->where('appointments.status' , 4)
            ->get();
        $dataDoctor = $this->tableSelect('doctors')->get();
        $dataService = $this->tableSelect('services')->get();
        $dataTypePet = $this->tableSelect('type_pets')->get();
        $permission_crud = $this->permissionCheckCrud;
        return view($this->pathView.'bills' , compact('data' , 'permission_crud'
            , 'dataService' , 'dataTypePet' , 'dataDoctor'))
            ->with([
                'colums' => $this->columns('index'),
                'urlbase' => $this->urlbase,
                'title_web' => $this->title,
                'products' => $products,
            ]);
    }

    public function AddAppointments() {
        return view($this->pathView . 'add-appointments');
    }

    public function clearAppointmentData() {
        $currentDate = Carbon::now()->toDateString(); // Lấy ngày hiện tại
        $currentTime = now()->toTimeString();
        Appointment::whereIn('status', [0, 1, 6, 7])
            ->whereDate('date', '<', $currentDate)
            ->update(['status' => 4]);

        // Soft delete records
        Appointment::whereIn('status', [0, 1, 6, 7])
            ->whereDate('date', '<', $currentDate)
            ->delete();

        $bills = Bill::whereIn('appointments.status', [0, 1, 6, 7])
            ->whereDate('appointments.date', '<=', $currentDate)
            ->where('w.end_time', '<', $currentTime)
            ->select('appointments.status' , 'appointments.date' , 'appointments.id')
            ->addSelect('w.start_time' , 'w.end_time')
            ->addSelect('appointments.status')
            ->join('doctors', 'doctors.id', '=', 'bills.doctor_id')
            ->join('appointments', 'appointments.id', '=', 'bills.appointment_id')
            ->join('work_schedules as w', function ($join) {
                $join->on('appointments.date', '=', 'w.date')
                    ->on('appointments.doctor_id', '=', 'w.doctor_id')
                    ->on('appointments.shift_name', '=', 'w.shift_name');
            })->delete();

        return back()->with(['success' => 'Đã hủy thành công']);
    }

    public function show(string $id) {
        $data = $this->queryCommon()->where('appointments.id' , $id)
            ->addSelect('w.start_time' , 'w.end_time' , 'users.avatar as image_user'
                , 'doctors.image as image_doctor' , 'appointments.status')
            ->join('work_schedules as w', function ($join) {
                $join->on('appointments.date', '=', 'w.date')
                    ->on('appointments.doctor_id', '=', 'w.doctor_id')
                    ->on('appointments.shift_name', '=', 'w.shift_name');
            })
            ->first();
        return view($this->pathView.'show' , compact('data'));
    }
}
