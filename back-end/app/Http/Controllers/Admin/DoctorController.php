<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends BaseAdminController
{
    public $model = Doctor::class;
    public $pathView = 'admin.baseCrud.';
    public $urlbase = 'doctors.';
    public $slug = 'slug';
    public $fieldImage = 'image';
    public $folderImage = 'image/doctors';


    public $titleIndex = 'Danh sách bác sĩ';
    public $titleCreate = 'Thêm mới bác sĩ';
    public $titleShow = 'Xem chi tiết  bác sĩ';
    public $titleEdit = 'Cập nhật  bác sĩ';

    protected $title = 'Bác sĩ';

    public $colums = [
        'image' => 'Ảnh',
        'name' => 'Tên bác sĩ',
        'phone'=>'Số điện thoại',
        'description' => 'Mô tả',
        'status'=>'Trạng thái',
      
      
    ];
    protected $permissionCheckCrud = 'doctors';
}
