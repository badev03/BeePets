<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class DoctorAccountController extends BaseAdminController
{
    public $model = Doctor::class;
    public $urlbase = 'doctorAccount.';
    public $folderImage = 'image/doctorAccount';
    public $title = 'Thông tin bác sĩ';
    public $listIndex = ['Role'];
    public $colums = [
        'name' => 'Tên người dùng',
        'email' => 'Email',
        'phone' => 'Số điên thoại',
        'password' => 'Mật khẩu',
        'address' => 'Địa chỉ',
        'image' => 'Ảnh người dùng',
        'status' => 'Trạng thái',
        'gender' => 'Giới tính',
        'description' => 'Mô tả',
        'birthday' => 'Ngày sinh',
    ];
    protected $FIELD_SELECT_CUSTOM_CONTROLLER = ['role'];


    public $checkerNameSlug = true;
    protected $permissionCheckCrud = 'DoctorAccount';
    public function addDataSelect() {
        $role = Role::all();
        $serviceCategorie = DB::table('service_categories')->get();
        $dataSelectPush = [
            'role' => $role,
            'address' => $serviceCategorie
        ];
        return $dataSelectPush;
    }


}
