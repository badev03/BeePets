<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Type_pet;
use App\Models\User;
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
//        'start_time'=>'Thời gian hẹn',
//        'end_time' => 'Thời gian kết thúc'
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
        $appointments = DB::table('appointments')
            ->join('doctors', 'doctor_id', '=', 'appointments.id')
            ->join('work_schedules', 'work_schedules.doctor_id', '=', 'doctors.id')
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->join('type_pets', 'type_pets.id', '=', 'appointments.type_pet_id')
            ->join('services', 'services.id', '=', 'appointments.service_id')
            ->select('appointments.description' , 'doctors.name as doctor_id' , 'users.name as user_id',
                'type_pets.name as type_pet_id' , 'services.name as service_id' , 'appointments.id',
                'work_schedules.end_time'
                , 'work_schedules.start_time', 'work_schedules.day_of_week', 'work_schedules.end_time', 'work_schedules.word_shift')
            ->get();
        return $appointments;
    }
}
