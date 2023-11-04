<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseAdminController;
use App\Models\About;

class AboutController extends BaseAdminController
{
    public $model = About::class;
    public $urlbase = 'about.';
    public $fieldImage = 'image';
    public $folderImage = 'image/about';
    public $pathView = 'admin.baseCrud.';


    public $title = 'Giới thiệu';
    protected $permissionCheckCrud = 'about';
    public $colums = [
        'image' => 'Hình Ảnh',

       
        'title' => 'Tiêu đề',
        'content'=>'Nội dung',
        'status' => 'Trạng thái',
    ];
}

