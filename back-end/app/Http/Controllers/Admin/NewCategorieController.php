<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\New_categorie;
use Illuminate\Http\Request;

class NewCategorieController extends BaseAdminController
{
    public $model = New_categorie::class;
    public $urlbase = 'new-categories.';
    public $fieldImage = 'image';
    public $folderImage = 'image/new_categories';

    public $title = 'Danh mục tin tức';
    protected $permissionCheckCrud = 'new-categories';
    public $colums = [
        'name' => 'Tên danh mục tin tức',
        'slug' => 'Slug',
        'description' => 'mô tả',
        'status' => 'Trạng thái',
    ];
    protected $removeColumns= ['slug'];
}
