<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Service_categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class ServiceController extends BaseAdminController
{
    public $model = Service::class;
    public $pathView = 'admin.baseCrud.';
    public $urlbase = 'service.';
    public $fieldImage = 'image';
    public $folderImage = 'image/service';
    protected $validateUpdateNew = true;



    protected $title = 'Dịch vụ';
    protected $permissionCheckCrud = 'service';

    /**
     * Chỉ cần để title ở đây rồi customer tiền tố ở view base là ok nhé
     * Nếu để tilteIndex và $titleCreate ... thì phải viết lại nhiều lần cái này tùy nhé
     */

    protected $FIELD_SELECT_CUSTOM_CONTROLLER = ['service_categorie_id'];
    public $colums = [
        'name' => 'Tên dịch vụ',
        'slug' => 'Slug',
        'description' => 'mô tả',
        'price'=>'Giá',
        'image' => 'ảnh',
        'icon_svg' => 'Icon',
        'service_categorie_id' => 'Danh mục dịch vụ'
    ];

    public $listIndex = ['Categories'];

    public function validateStore($request , $id=null)
    {
        $this->validate($request,[
            'name' => 'required|unique:services',
            'description' => 'required' ,
            'price' => 'required|numeric|min:1'
        ],
            [
                'name.required' => 'Tên danh mục dịch vụ không được để trống',
                'name.unique' => 'Tên danh mục dịch vụ không được trùng nhau',
                'description.required' => 'Mô tả danh mục dịch vụ không được để trống',
                'price.required' => 'Giá danh mục dịch vụ không được để trống',
                'price.numeric' => 'Giá phải là số',
                'price.min' => 'Giá phải lớn hơn 0',
            ]
        );
    }
    public function addDataSelect() {
        $serviceCategorie = DB::table('service_categories')->select('id' , 'name')->get();
        $dataForMergeArray = [
            'service_categorie_id' => $serviceCategorie,
        ];
        return $dataForMergeArray;
    }

    public function validateUpdateNew($request , $id) {
        $this->validate($request,[
            'name' => 'required|unique:services,name,' . $id . ',id',
            'description' => 'required' ,
            'price' => 'required|numeric|min:1'
        ],
            [
                'name.required' => 'Tên danh mục dịch vụ không được để trống',
                'name.unique' => 'Tên danh mục dịch vụ không được trùng nhau',
                'description.required' => 'Mô tả danh mục dịch vụ không được để trống',
                'price.required' => 'Giá danh mục dịch vụ không được để trống',
                'price.numeric' => 'Giá phải là số',
                'price.min' => 'Giá phải lớn hơn 0',
            ]
        );
    }

    /**
     * select mặc định phải gán với tên là ids and name
    */

    public $removeColumns = ['icon_svg' , 'description'];
    protected $delete_trash = 'is_trash';
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
