<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Service_categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceCategorieController extends BaseAdminController
{

    public $model = Service_categorie::class;
    public $pathView = 'admin.baseCrud.';
    public $urlbase = 'service-categories.';
    public $fieldImage = 'image';
    public $folderImage = 'image/serCateImage';
    public $titleIndex = 'Danh sách Dịch vụ';
    public $titleCreate = 'Thêm mới Dịch vụ';
    public $titleShow = 'Xem chi tiết Dịch vụ';
    public $titleEdit = 'Cập nhật Dịch vụ';
    public $removeColumns = ['description'];
    public $title = 'Danh mục dịch vụ';
    protected $validateUpdateNew = true;
    protected $permissionCheckCrud = 'category-service';
    public $colums = [
        'name' => 'Tên dịch vụ',
        'slug' => 'Slug',
        'description' => 'mô tả',
        // 'image'=>'Ảnh'
    ];

    protected $delete_trash = 'is_trash';

    public function validateStore($request , $id = null)
    {
        $this->validate($request,[
            'name' => 'required|unique:service_categories',
            'description' => 'required'
        ],
            [
                'name.required' => 'Tên danh mục dịch vụ không được để trống',
                'name.unique' => 'Tên danh mục dịch vụ không được trùng nhau',
                'description.required' => 'Mô tả danh mục dịch vụ không được để trống'
            ]
        );
    }

    public function validateUpdateNew($request , $id) {
        $this->validate($request,[
            'name' => 'required|unique:service_categories,name,' . $id . ',id',
            'description' => 'required'
        ],
            [
                'name.required' => 'Tên danh mục dịch vụ không được để trống',
                'name.unique' => 'Tên danh mục dịch vụ không được trùng nhau',
                'description.required' => 'Mô tả danh mục dịch vụ không được để trống'
            ]
        );
    }

    public function destroy(string $id)
    {
        if (auth()->user()->can(['delete-'.$this->permissionCheckCrud])) {
            $model = $this->model->findOrFail($id);
            $model->update(['is_trash' => 1]);
            if ($model->image) {
                $image = str_replace('storage/', '', $model->{$this->fieldImage});
                Storage::delete($image);
            }
            return back()->with('success_delete', 'Đã xóa thành công');
        }
        else {
            return view(admin_403);
        }
    }

}
