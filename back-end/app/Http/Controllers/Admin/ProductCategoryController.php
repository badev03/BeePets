<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Product_categories;
use Illuminate\Http\Request;

class ProductCategoryController extends BaseAdminController
{
    public $model = Product_categories::class;
    public $pathView = 'admin.baseCrud.';
    public $urlbase = 'product-categories.';
    public $slug = 'slug';
    public $permissionCheckCrud = 'role';

    public $titleIndex = 'Danh mục sản phẩm';
    public $titleCreate = 'Thêm danh mục sản phẩm';
    public $titleShow = 'Xem chi tiết danh mục sản phẩm';
    public $titleEdit = 'Cập nhật danh mục sản phẩm';

    protected $title = 'Danh mục sản phẩm';

    /*
     * Chỉ cần để title ở đây rồi customer tiền tố ở view base là ok nhé
     * Nếu để tilteIndex và $titleCreate ... thì phải viết lại nhiều lần cái này tùy nhé
     * */

    public $colums = [
        'name' => 'Tên Danh mục',
        'description' => 'mô tả',
    ];
    public function validateStore($request, $id = null)
    {
        if($id){
            $rules = [
                'name' => 'required|unique:product_categories,name,'.$id,
            ];
        }else{
            $rules = [
                'name' => 'required|unique:product_categories,name',
            ];
        }
        $messages = [
            'name.required' => 'Tên danh mục không được để trống',
            'name.unique' => 'Tên danh mục đã tồn tại',
        ];
        $request->validate($rules, $messages);
    }

}
