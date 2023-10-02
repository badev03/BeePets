<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends BaseAdminController
{
    public $model = Appointment::class;
    public $urlbase = 'appointment.';
    public $fieldImage = 'image';
    public $folderImage = 'image/appointment';

    public $title = 'Cuộc hẹn';
    protected $permissionCheckCrud = 'appointment';
    public $colums = [
        'doctor_id' => 'Tên bác sĩ',
        'user_id' => 'Bệnh nhân',
        'description' => 'mô tả',
        'image'=>'Ảnh'
    ];
}
