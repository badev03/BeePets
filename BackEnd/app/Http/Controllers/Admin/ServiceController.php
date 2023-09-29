<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Service_categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends BaseAdminController
{
    public $model = Service::class;
    public $pathView = 'admin.baseCrud.';
    public $urlbase = 'service.';
    public $fieldImage = 'image';
    public $folderImage = 'image/serCateImage';


    public $titleIndex = 'Danh sách Dịch vụ';
    public $titleCreate = 'Thêm mới Dịch vụ';
    public $titleShow = 'Xem chi tiết Dịch vụ';
    public $titleEdit = 'Cập nhật Dịch vụ';

    protected $title = 'Dịch vụ';
    /*
     * Chỉ cần để title ở đây rồi customer tiền tố ở view base là ok nhé
     * Nếu để tilteIndex và $titleCreate ... thì phải viết lại nhiều lần cái này tùy nhé
     * */

    public $colums = [
        'name' => 'Tên dịch vụ',
        'slug' => 'Slug',
        'description' => 'mô tả',
        'price'=>'Giá',
        'image' => 'ảnh',
        'service_categorie_id' => 'Danh mục dịch vụ'
    ];

    public function validateStore($request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required' ,
            'price' => 'required|numeric|min:1'
        ],
            [
                'name.required' => 'Tên danh mục dịch vụ không được để trống',
                'description.required' => 'Mô tả danh mục dịch vụ không được để trống',
                'price.required' => 'Giá danh mục dịch vụ không được để trống',
                'price.numeric' => 'Giá phải là số',
                'price.min' => 'Giá phải lớn hơn 0',
            ]
        );
    }

    public function addData() {
        $serviceCategorie = DB::table('service_categories')->get();
        return $serviceCategorie;
    }
}
