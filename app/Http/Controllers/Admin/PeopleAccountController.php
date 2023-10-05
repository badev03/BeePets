<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PeopleAccountController extends BaseAdminController
{
    public $model = User::class;
    public $urlbase = 'people-account.';
    public $folderImage = 'image/peopleAccount';
    public $title = 'Tài khoản người dùng';
    public $listIndex = ['Role'];
    public $fieldImage = 'avatar';
    public $colums = [
        'name' => 'Tên người dùng',
        'email' => 'Email',
        'phone' => 'Số điên thoại',
        'password' => 'Mật khẩu',
        'address' => 'Địa chỉ',
        'avatar' => 'Ảnh người dùng',
        'status' => 'Trạng thái',
        'gender' => 'Giới tính',
        'role_id' => 'Vai trò'
    ];
    protected $FIELD_SELECT_CUSTOM_CONTROLLER = ['role_id'];
    protected $addForDataViewer = [];

    public $checkerNameSlug = false;
    protected $checkRolePermission = 'permission';
    protected $checkerReturnView = false;
    protected $permissionCheckCrud = 'PeopleAccount';
    /**
     * @return ham addDataSelect ở controller peopleAccountController phải khai báo theo chuẩn như thế này
     * còn ở các controller khác thì chỉ cần lấy hàm name và chuẩn id thành ids là ok
     */
    public function addDataSelect() {
        $role = Role::select('name' , 'id')->get();
        $dataSelectPush = [
            'role_id' => $role,
        ];
        return $dataSelectPush;
    }

    public function addFunctionData()
    {
        $this->checkerReturnView = true;
        $titleTester = '111';
        $permission = Permission::all()->groupBy('group');
        $permissionsArray = Permission::all()->pluck('name')->toArray();
        $this->addForDataViewer = [
            'titleTester' => $titleTester,
            'permission' => $permission,
            'permissionsArray' => $permissionsArray
        ];
    }

    public function addFunctionDataEdit($id)
    {
        $this->checkerReturnView = true;
        $user = User::find($id);
        $permission = Permission::all()->groupBy('group');
        $permissionsArray = Permission::all()->pluck('name')->toArray();
        $permissionOfPeople = $user->permissions->pluck('name')->toArray();
//        dd($permissionOfPeople);
        $this->addForDataViewer = [
            'permission' => $permission,
            'permissionsArray' => $permissionsArray,
            'permissionOfPeople' => $permissionOfPeople
        ];
    }

    public function selectDataIndex()
    {
        return Role::all();
    }
}
