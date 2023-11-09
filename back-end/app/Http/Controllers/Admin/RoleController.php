<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BaseAdminController
{
    public $model = Role::class;
    public $urlbase = 'role.';
    public $folderImage = 'image/Role';
    public $title = 'Vai trò';
    public $colums = [
        'name' => 'Tên trò',
        'guard_name' => 'Tên bảo vệ',
    ];

    public $checkerNameSlug = false;
    protected $permissionCheckCrud = 'role';

    /**
     * protected $removeColumns= ['test'];
     * Xóa đi trường ko muốn validate
     * */

    public function validateOverWriteStore() {

    }

    public function store(Request $request)
    {
        $model = new $this->model;
        $this->validate($request,[
            'name' => 'required',
            'guard_name' => 'required'
        ],
            [
                'name.required' => 'Tên vai trò không được để trống',
                'guard_name.required' => 'Tên bảo vệ vai trò không được để trống'
            ]
        );
        $model->fill($request->except([$this->fieldImage,$this->slug]));
        $model->guard_name = 'web';
        $model->save();
        if (isset($request->permissions)) {
            foreach ($request->permissions as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                if ($permission) {
                    $model->givePermissionTo($permission);
                }
            }
        }
        return back()->with('success', 'Thao tác thành công');
    }


    /**
     * Dat Writter
     * Tao đang check xem 1 admin thì được làm những cái gì bằng việc check bảng role_has_permissions
     * $adminRole = Role::findByName('admin2');
     * $permissions = $adminRole->permissions;
    */
    public function create() {
        $title_web = $this->title;
        $urlbase = $this->urlbase;
        $permission = Permission::all()->groupBy('group');
        return view('admin.role.create' , compact('title_web' , 'urlbase'))
            ->with('colums', $this->colums)
            ->with('permission' , $permission);
    }

    public function edit(string $id)
    {
        $model = Role::findOrFail($id);
        $adminRole = Role::findByName($model->name);
        $permissions = $adminRole->permissions;
//        $permission = Permission::all();
        $permission = Permission::all()->groupBy('group');
        $permissionsArray = $permissions->pluck('name')->toArray();
        return view('admin.role.edit' , compact('model'))
            ->with('colums', $this->colums)
            ->with('urlbase', $this->urlbase)
            ->with('permissions', $permissions)
            ->with('permission', $permission)
            ->with('permissionsArray', $permissionsArray)
            ->with('title_web', $this->title);
    }

    public function update(Request $request, string $id)
    {

        $this->validate($request,[
            'name' => 'required',
            'guard_name' => 'required'
        ],
            [
                'name.required' => 'Tên vai trò không được để trống',
                'guard_name.required' => 'Tên bảo vệ vai trò không được để trống'
            ]
        );

        $model = Role::findOrFail($id);

        $model->fill($request->except([$this->fieldImage]));
        $model->guard_name = 'web';
        $model->save();
        if (isset($request->permissions)) {
            $model->syncPermissions($request->permissions);
        }

        return back()->with('success', 'Thao tác thành công');
    }
}
