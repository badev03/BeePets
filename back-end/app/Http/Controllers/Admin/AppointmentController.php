<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Type_pet;
use App\Models\User;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends BaseAdminController
{
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
            'description' => 'required' ,
        ],
            [
                'description.required' => 'Mô tả không được để trống',
            ]
        );
        $this->tableQuery('appointments')->insert($request->except('_token'));
        return back()->with('success', 'Thao tác thành công');
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
            ->first();
        $time_work_shift = DB::table('work_schedules')
            ->where('doctor_id' , '=' , $model->id_doctor)
            ->where('day' , '=' , $model->day)
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
            'time_work_shift' => $time_work_shift,
            'time_set_up_shift' => $time_set_up_shift,
            'FIELD_SELECT_CUSTOM_CONTROLLER' => $this->FIELD_SELECT_CUSTOM_CONTROLLER,
            'dataDoctor' => $dataDoctor,
            'dataService' => $dataService,
            'dataTypePet' => $dataTypePet,
        ];
        return view($this->pathView.__FUNCTION__ , compact('model'))
            ->with($dataViewer);

    }

    public function queryCommon() {
        $query = DB::table('appointments')
            ->join('doctors', 'doctor_id', '=', 'appointments.id')
            ->join('work_schedules', 'work_schedules.doctor_id', '=', 'doctors.id')
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->join('type_pets', 'type_pets.id', '=', 'appointments.type_pet_id')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->select('appointments.description' , 'doctors.name as doctor_id' , 'users.name as user_id',
                'type_pets.name as type_pet_id' , 'services.name as service_id' , 'appointments.id',
                'work_schedules.end_time' , 'appointments.doctor_id as id_doctor' , 'work_schedules.day'
                    , 'work_schedules.start_time', 'work_schedules.day_of_week', 'work_schedules.end_time', 'work_schedules.word_shift');
        return $query;
    }

    public function update(Request $request, string $id)
    {
        dd($request->all());
    }

    public function getDay($day , $id){
        $time_work_shift = DB::table('work_schedules')
        ->where('doctor_id' , '=' , $id)
        ->where('day' , '=' ,$day)->get();
        return response()->json([
            'time_work_shift' => $time_work_shift
        ] , '200');
    }

    public function FilterDate($data) {
        $day_appointments = $this->QueryFilter()->where('appointments.day_appointments' , '=' , $data)->get();
        return response()->json(['day_appointments'=> $day_appointments] , '200');
    }

    public function tableQuery($table) {
        $table = DB::table($table);
        return $table;
    }

    public function QueryFilter () {
        $query = DB::table('appointments')
            ->join('doctors', 'doctor_id', '=', 'appointments.id')
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->join('type_pets', 'type_pets.id', '=', 'appointments.type_pet_id')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->select('appointments.description' , 'doctors.name as doctor_id' , 'users.name as user_id',
                'type_pets.name as type_pet_id' , 'services.name as service_id' , 'appointments.id',
                 'appointments.doctor_id as id_doctor' , 'appointments.shift_appointment' , 'appointments.day_appointments'
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
        $time_appointments = $this->QueryFilter()->where('appointments.shift_appointment' , '=' , $data)->get();
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
            ->where('day' , '=' , date('Y-m-d'))
            ->get();
        $checkTime = $this->tableQuery('appointments')->where('day_appointments' , '=' , date('Y-m-d'))
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
        ];
        return view($this->pathView.'create' , compact('user'))
            ->with($dataViewer);
    }


}
