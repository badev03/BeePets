<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends BaseAdminController
{
    public $model = Permission::class;
    public $urlbase = 'permission.';
    public $title = 'Quyền';

    public $colums = [
        'name' => 'Tên quyền',
        'guard_name' => 'Tên bảo vệ',
        'group' => 'Nhóm',
    ];

    public $checkerNameSlug = false;
    protected $permissionCheckCrud = 'permission';
    protected $checkerReturnView = false;

    public function addFunctionDataEdit($id) {
        $this->checkerReturnView = true;
        $role = Role::all();
        $this->addForDataViewer = [
            'role' => $role
        ];
    }
    public function addFunctionData()
    {
        $this->checkerReturnView = true;
        $role = Role::all();
        $this->addForDataViewer = [
            'role' => $role
        ];
    }

    public function store(Request $request)
    {
        $model = new $this->model;
        $this->validate($request,[
            'name' => 'required',
            'guard_name' => 'required',
        ],
            [
                'name.required' => 'Tên vai trò không được để trống',
                'guard_name.required' => 'Tên bảo vệ vai trò không được để trống',
            ]
        );
        $model->fill($request->except([$this->fieldImage,$this->slug]));
        $model->save();


        $roles = $request->input('role', []);

        $model->roles()->detach();

        foreach ($roles as $roleName) {
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $role->givePermissionTo($model->name);
            }
        }
        return back()->with('success', 'Thao tác thành công');
    }

    public function update(Request $request, string $id)
    {
        $model = $this->model->findOrFail($id);
        $this->validate($request,[
            'name' => 'required',
            'guard_name' => 'required',
            'group' => 'required',
        ],
            [
                'name.required' => 'Tên vai trò không được để trống',
                'guard_name.required' => 'Tên bảo vệ vai trò không được để trống',
                'group.required' => 'Trường Group bảo vệ vai trò không được để trống',
            ]
        );
        $model->fill($request->except([$this->fieldImage,$this->slug]));
        $model->save();
        $permission = Permission::findByName($request->name);

        if ($permission) {

            $roles = $request->input('role', []);

            $permission->roles()->detach();

            foreach ($roles as $roleName) {
                $role = Role::where('name', $roleName)->first();
                if ($role) {
                    $role->givePermissionTo($permission->name);
                }
            }
        }
        return back()->with('success', 'Thao tác thành công');
    }

}
