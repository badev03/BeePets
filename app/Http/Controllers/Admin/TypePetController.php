<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Type_pet;
use Illuminate\Http\Request;

class TypePetController extends BaseAdminController
{
    
    public $model = Type_pet::class;
    public $pathView = 'admin.baseCrud.';
    public $urlbase = 'type-pet.';
    public $fieldImage = 'image';
    public $folderImage = 'image/typePet';
    public $titleIndex = 'Danh sách Thú cưng';
    public $titleCreate = 'Thêm mới Thú cưng';
    public $titleShow = 'Xem chi tiết Thú cưng';
    public $titleEdit = 'Cập nhật Thú cưng';

    public $title = 'Danh mục Thú cưng';
    protected $permissionCheckCrud = 'typePet';
    public $colums = [
        'name' => 'Tên thú cưng',
     
    ];

}
