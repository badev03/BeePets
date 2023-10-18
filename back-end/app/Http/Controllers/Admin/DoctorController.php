<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class DoctorController extends Controller
{
    // public $model = Doctor::class;
    // public $pathView = 'admin.baseCrud.';
    // public $urlbase = 'doctors.';
    // public $slug = 'slug';
    // public $fieldImage = 'image';
    // public $folderImage = 'image/doctors';


    public $titleIndex = 'Danh sách bác sĩ';
    protected $removeColumns = [];
    public $titleShow = 'Xem chi tiết  bác sĩ';
    public $titleEdit = 'Cập nhật  bác sĩ';
    protected $checkerNameSlug = true;
    protected $title = 'Bác sĩ';
    protected $checkRolePermission = true;
    protected $permissionCheckCrud = 'doctors';
    public $colums = [
        'image' => 'Ảnh',
        'name' => 'Tên bác sĩ',
        'phone' => 'Số điện thoại',
        'description' => 'Mô tả',
        'address'=>'Địa chỉ',
        'gender'=>'Giới tính',
        'birthday'=>'Ngày Sinh',
        'status' => 'Trạng thái',


    ];



    public function index()
    {

        $doctors = Doctor::all();
        return view('admin.doctor.index', compact('doctors'))
            ->with('title', $this->titleIndex)
            ->with('title_web', $this->title)
            ->with('colums', $this->colums)
            ->with('permission_crud', $this->permissionCheckCrud);
    }

    public function create()
    {
        $services = Service::all();

        return view('admin.doctor.create', compact('services'))
            ->with('colums', $this->colums)
            ->with('permission_crud', $this->permissionCheckCrud);
    }
    public function createSlug($name)
    {
        return Str::slug($name);
    }
    public function store(Request $request)
    {

        $model = new Doctor();
        $validateStore = $this->validateStore($request);
        if ($validateStore) {
            return back()->withErrors($validateStore)->withInput();
        }
        $model->fill($request->except(['image', 'slug']));
        if ($request->hasFile('image')) {

            $image = $request->image;
            $cloudinaryResponse = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();

            $model->image = $cloudinaryResponse;
        }
        if ($request->has('name') && $this->checkerNameSlug == true) {
            $model->slug = $this->createSlug($request->name);
        }
        $dataModel = $request->all();
        if ($this->dataStoreAndUpdate($dataModel)) {
            $currentDate = today();
            $model->public_date = $currentDate->format('Y-m-d');
        }
        $this->createAndUpdatePassWord($request->password);

        $model->save();
        $selectedServices = $request->input('service_id', []);
        $model->services()->attach($selectedServices);
        if ($this->checkRolePermission == false) {
            $model->assignRole($request->role);
        }

        return back()->with('success', 'Thao tác thành công');
    }


    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $services = Service::select('id','name')->get();
        $dataViewer = [
            'title' => $this->titleEdit,
            'colums' => $this->colums,
            'permission_crud'=> $this->permissionCheckCrud
        ];
        return view('admin.doctor.edit', compact('doctor','services'))
            ->with($dataViewer);
    }
    public function update(Request $request,$id){
        $model = Doctor::findOrFail($id);
        $validateUpdate = $this->validateUpdate($request);
        if ($validateUpdate) {
            return back()->withErrors($validateUpdate)->withInput();
        }
        $model->fill($request->except(['image', 'slug']));
        if ($request->hasFile('image')) {
            $image = $request->image;
            $cloudinaryResponse = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $model->image = $cloudinaryResponse;
        }
        if ($request->has('name') && $this->checkerNameSlug == true) {
            $model->slug = $this->createSlug($request->name);
        }
        $dataModel = $request->all();
        if ($this->dataStoreAndUpdate($dataModel)) {
            $currentDate = today();
            $model->public_date = $currentDate->format('Y-m-d');
        }
        $this->createAndUpdatePassWord($request->password);
        $model->save();
        $selectedServices = $request->input('service_id', []);
        $model->services()->sync($selectedServices);
        if ($this->checkRolePermission == false) {
            $model->assignRole($request->role);
        }
        return back()->with('success', 'Thao tác thành công');





    }

    public function destroy(string $id)
    {
        if (auth()->user()->can(['delete-' . $this->permissionCheckCrud])) {
            $model = Doctor::findOrFail($id);

            $model->delete();
            if ($model->image) {
                Cloudinary::destroy($model->image);
            }
            return back()->with('success_delete', 'Đã xóa thành công');
        } else {
            return view(admin_403);
        }
    }



    public function validateStore($request, $id = null)
    {
        $rules = [];
        $keyForErrorMessage = [];
        foreach ($this->colums as $key => $item) {
            $rules[$key] = 'required';
        }
        if ($this->removeColumns) {
            $rules = array_diff_key($rules, array_flip($this->removeColumns));
        }
        foreach ($rules as $keyForError => $value) {
            $keyForErrorMessage[$keyForError . '.required'] = 'Trường ' . $keyForError . ' không được để trống';
        }
        $this->validate($request, $rules, $keyForErrorMessage);
    }

    public function validateUpdate($request)
    {
        return [];
    }

    public function addDataSelect()
    {
    }

    public function givePermission()
    {
    }

    public function addFunctionData()
    {
    }

    public function addFunctionDataEdit($id)
    {
    }

    public function selectDataIndex()
    {
    }

    public function checkPermissionsAndRole()
    {
        if ($this->permissionCheckCrud === 'permission') {
        }
    }

    public function createAndUpdatePassWord($password)
    {
        if ($password) {
            $password = Hash::make($password);
            return $password;
        }
    }

    public function QuerySpecialIndex()
    {
    }

    public function dataStoreAndUpdate($data)
    {
    }
}
