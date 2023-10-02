<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Service_categorie;
use Illuminate\Http\Request;

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

    public $title = 'Danh mục dịch vụ';
    protected $permissionCheckCrud = 'category-service';
    public $colums = [
        'name' => 'Tên dịch vụ',
        'slug' => 'Slug',
        'description' => 'mô tả',
        'image'=>'Ảnh'
    ];

    public function validateStore($request , $id = null)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
        ],
            [
                'name.required' => 'Tên danh mục dịch vụ không được để trống',
                'description.required' => 'Mô tả danh mục dịch vụ không được để trống'
            ]
        );
    }

}
