<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Newc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewController extends BaseAdminController
{
    public $model = Newc::class;
    public $urlbase = 'new.';
    public $folderImage = 'image/new';

    public $title = 'tin tức';
    protected $permissionCheckCrud = 'new';
    public $colums = [
        'name' => 'Tên tin tức' ,
        'slug' => 'Slug' ,
        'content' => 'Nội dung' ,
        'image' => 'ảnh',
        'new_categorie_id' => 'Danh mục tin tức'
    ];
    protected $removeColumns = ['slug'];
    protected $FIELD_SELECT_CUSTOM_CONTROLLER = ['new_categorie_id'];
    public $listIndex = ['Categories'];

    public function addDataSelect() {
        $Categories = DB::table('new_categories')->select('id' , 'name')->get();
        $dataForMergeArray = [
            'new_categorie_id' => $Categories,
        ];
        return $dataForMergeArray;
    }

    public function dataStoreAndUpdate($data) {
        $currentDate = today();
        $public_date = $currentDate->format('Y-m-d');
        return $public_date;
    }


}
