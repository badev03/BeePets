<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Product_categories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends BaseAdminController
{
    public $model = Products::class;
    public $pathView = 'admin.baseCrud.';
    public $urlbase = 'products.';
    public $slug = 'slug';
    public $fieldImage = 'image';
    public $folderImage = 'image/products';
    protected $permissionCheckCrud = 'role';
    protected $FIELD_SELECT_CUSTOM_CONTROLLER = ['product_categorie_id'];
    public $listIndex = ['Categories'];
    public $titleIndex = 'Danh sách sản phẩm';
    public $titleCreate = 'Thêm mới sản phẩm';
    public $titleShow = 'Xem chi tiết  sản phẩm';
    public $titleEdit = 'Cập nhật  sản phẩm';

    protected $title = 'Sản phẩm';

    public $colums = [
        'name' => 'Tên sản phẩm',
        'description' => 'Mô tả',
        'price' => 'Giá',
        'quantity' => 'Số lượng',
        'image' => 'Ảnh',
        'product_categorie_id' => 'Danh mục sản phẩm'
    ];
    public function addDataSelect()
    {
        $product_categories = Product_categories::all();
        $dataForMergeArray = [
            'product_categorie_id' => $product_categories
        ];
        return $dataForMergeArray;
    }
    public function validateStore($request,$id = null)
    {
        if($id){
            $rules = [
                'name' => 'required|unique:products,name,'.$id,
                'price' => 'required',
                'quantity' => 'required',
                'image' => 'required',
                'product_categorie_id' => 'required',
            ];
        }else{
            $rules = [
                'name' => 'required|unique:products,name',
                'price' => 'required',
                'quantity' => 'required',
                'image' => 'required',
                'product_categorie_id' => 'required',
            ];
        }
        $messages = [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'price.required' => 'Giá sản phẩm không được để trống',
            'quantity.required' => 'Số lượng sản phẩm không được để trống',
            'image.required' => 'Ảnh sản phẩm không được để trống',
            'product_categorie_id.required' => 'Danh mục sản phẩm không được để trống',
        ];
    }



}
