<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Type_pet;
use App\Models\User;
use App\Traits\QueryCommon;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends BaseAdminController
{
    use QueryCommon;
    public $model = Appointment::class;
    public $urlbase = 'appointment.';
    public $fieldImage = 'image';
    public $pathView = 'admin.appointments.';
    public $folderImage = 'image/appointment';

    public $title = 'Cuộc hẹn';
    protected $permissionCheckCrud = 'appointment';
    public $listIndex = ['Doctor' , 'User' , 'TypePet' , 'Service'];
    protected $FIELD_SELECT_CUSTOM_CONTROLLER= ['doctor_id' , 'user_id','type_pet_id' , 'service_id' ];
    public $colums = [
        'doctor_id' => 'Tên bác sĩ',
        'user_id' => 'Bệnh nhân',
        'type_pet_id' => 'Loại thứ cưng',
        'service_id' => 'Tên dịch vụ',
        'description' => 'Mô tả',
    ];
    protected $special = ['start_time' , 'end_time'];
    public function addDataSelect() {
        $Doctor = Doctor::all();
        $User = User::all();
        $TypePet = Type_pet::all();
        $Service = Service::all();
        $dataForMergeArray = [
            'doctor_id' => $Doctor,
            'user_id' => $User,
            'type_pet_id' => $TypePet,
            'service_id' => $Service,
        ];
        return $dataForMergeArray;
    }

    /**
     * Tên key phải trùng với giá trị value trong của thuộc tính $FIELD_SELECT_CUSTOM_CONTROLLER
    */

    public function QuerySpecialIndex()
    {
        $appointments = $this->queryCommon()
            ->get();
        return $appointments;
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'description' => 'required',
            'service_id' => 'required|nullable',
            'doctor_id' => 'required',
            'date' => 'required',
            'shift_name' => 'required',
        ],
            [
                'description.required' => 'Trường mô tả không được để trống',
                'service_id.required' => 'Trường dịch vụ không được để trống',
                'service_id.nullable' => 'Trường dịch vụ bắt buộc phải chọn',
                'doctor_id.required' => 'Trường Bác sĩ không được để trống',
                'date.required' => 'Trường ngày đặt không được để trống',
                'shift_name.required' => 'Trường ca đặt không được để trống',
            ]
        );
        $data = [
            'time' =>now(),
            'created_at' => $this->getTimestampQuery(),
            'updated_at' => $this->getTimestampQuery(),
        ];
        $checkShift = $this->tableQuery('appointments')
            ->where('user_id' , '=' , $request->user_id)
            ->where('date' , '=' , $request->date)
            ->where('shift_name' , '=' , $request->shift_name)
            ->first();
        if($checkShift) {
            return back()->with('error', 'Xin lỗi lịch đặt của bạn đã bị trùng với lịch bạn đặt trước đó');
        }
        $checkPhone = $this->tableQuery('users')
            ->where('role_id' , '=' , 4)
            ->where('phone' , '=' , $request->user_id)
            ->first();
        if($checkPhone) {
            $data['user_id'] = $checkPhone->id;
            $this->tableQuery('appointments')->insert(array_merge($request->except('_token' , 'user_id') , $data));
            return back()->with('success', 'Thao tác thành công');
        }
        else {
            $data['user_id'] = $this->createUserAuto($request->user_id);
            $this->tableQuery('appointments')->insert(array_merge($request->except('_token') , $data));
            return back()->with('success', 'Thao tác thành công');
        }
    }

    public function edit(string $id)
    {
         $this->colums = [
            'doctor_id' => 'Tên bác sĩ',
            'type_pet_id' => 'Loại thứ cưng',
            'service_id' => 'Tên dịch vụ',
            'description' => 'Mô tả',
        ];
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
        $dataDoctor = $this->tableQuery('doctors')->get();
        $dataService = $this->tableQuery('services')->get();
        $dataTypePet = $this->tableQuery('type_pets')->get();
        $time_set_up_shift = ['09:00:00-11:00:00' , '11:00:00-13:00:00' , '13:00:00-15:00:00'];
        $dataViewer = [
            'title' => $this->titleEdit,
            'colums' => $this->colums,
            'urlbase' => $this->urlbase,
            'title_web' => $this->title,
            'listIndex' => $this->listIndex,
            'time_set_up_shift' => $time_set_up_shift,
            'FIELD_SELECT_CUSTOM_CONTROLLER' => $this->FIELD_SELECT_CUSTOM_CONTROLLER,
            'dataDoctor' => $dataDoctor,
            'dataService' => $dataService,
            'dataTypePet' => $dataTypePet,
        ];
        return view($this->pathView.__FUNCTION__ , compact('model' , 'user' , 'getDayDefault'))
            ->with($dataViewer);

    }

    public function queryCommon() {
        $query = DB::table('appointments')
            ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->join('type_pets', 'type_pets.id', '=', 'appointments.type_pet_id')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->select('appointments.description' , 'appointments.date' , 'appointments.id'
                , 'doctors.name as doctor_id' , 'users.name as user_id', 'users.id as id_user',
                'type_pets.name as type_pet_id' , 'services.name as service_id' , 'appointments.shift_name',
                 'appointments.doctor_id as id_doctor');
        return $query;
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'description' => 'required',
            'service_id' => 'required|nullable',
            'doctor_id' => 'required',
            'date' => 'required',
            'shift_name' => 'required',
            'user_id' => 'required',
        ],
            [
                'description.required' => 'Trường mô tả không được để trống',
                'service_id.required' => 'Trường dịch vụ không được để trống',
                'service_id.nullable' => 'Trường dịch vụ bắt buộc phải chọn',
                'doctor_id.required' => 'Trường Bác sĩ không được để trống',
                'date.required' => 'Trường ngày đặt không được để trống',
                'shift_name.required' => 'Trường ca đặt không được để trống',
                'user_id.required' => 'Trường user đặt không được để trống',
            ]
        );
        $phone = $request->user_id;
        if($phone) {
            $checkPhone = $this->tableQuery('users')
                ->where('role_id' , '=' , 4)
                ->where('phone' , '=' , $phone)
                ->first();
            if($checkPhone) {
                $data = [
                    'time' =>now(),
                    'updated_at' => $this->getTimestampQuery(),
                ];
                $this->tableQuery('appointments')
                    ->where('id' , '=' , $id)
                    ->update(array_merge($request->except(['_token' , '_method' , 'user_id']) , $data));
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

    public function FilterDate($data) {
        $day_appointments = $this->QueryFilter()->where('appointments.date' , '=' , $data)->get();
        return response()->json(['day_appointments'=> $day_appointments] , '200');
    }

    public function tableQuery($table) {
        $table = DB::table($table);
        return $table;
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
                );
        return $query;
    }

    public function index()
    {
        $data = $this->QuerySpecialIndex();
        $dataDoctor = $this->tableQuery('doctors')->get();
        $dataService = $this->tableQuery('services')->get();
        $dataTypePet = $this->tableQuery('type_pets')->get();
        $permission_crud = $this->permissionCheckCrud;
        $dataViewer = [
            'title' => $this->titleEdit,
            'colums' => $this->colums,
            'urlbase' => $this->urlbase,
            'title_web' => $this->title,
            'FIELD_SELECT_CUSTOM_CONTROLLER' => $this->FIELD_SELECT_CUSTOM_CONTROLLER,
            'dataDoctor' => $dataDoctor,
            'special', $this->special,
        ];
        return view($this->pathView.'index' , compact('data' , 'permission_crud'
        , 'dataService' , 'dataTypePet'))
            ->with($dataViewer);
    }

    public function FilterSearch(Request $request) {
        $searchTerm = $request->input('searchTerm');
        $searchName = $this->QueryFilter()
            ->where('users.name' , 'like' , '%'.$searchTerm.'%')->get();
        return response()->json([
            'searchUser' => $searchName
        ] , '200');
    }

    public function FilterTime($data) {
        $time_appointments = $this->QueryFilter()->where('appointments.shift_name' , '=' , $data)->get();
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

        $dataDoctor = $this->tableQuery('doctors')->get();
        $dataService = $this->tableQuery('services')->get();
        $dataTypePet = $this->tableQuery('type_pets')->get();
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
            'title' => $this->titleEdit,
            'colums' => $this->colums,
            'urlbase' => $this->urlbase,
            'title_web' => $this->title,
            'listIndex' => $this->listIndex,
            'dataDoctor' => $dataDoctor,
            'dataService' => $dataService,
            'timeWork' => $timeWork,
            'dataTypePet' => $dataTypePet,
            'data_time_appointments' => $mergedArray,
            'FIELD_SELECT_CUSTOM_CONTROLLER' => $this->FIELD_SELECT_CUSTOM_CONTROLLER,
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

    public function FilterService($data) {
        $service = $this->QueryFilter()->where('appointments.service_id' , '=' , $data)->get();
        return response()->json(['service'=> $service] , '200');
    }

    public function FilterDoctor($data) {
        $doctor = $this->QueryFilter()->where('appointments.doctor_id' , '=' , $data)->get();
        return response()->json(['doctor'=> $doctor] , '200');
    }


}
