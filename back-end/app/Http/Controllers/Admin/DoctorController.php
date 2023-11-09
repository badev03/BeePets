<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Support\Str;
use App\Models\Doctor_image;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
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
        'address' => 'Địa chỉ',
        'gender' => 'Giới tính',
        'birthday' => 'Ngày Sinh',
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

        $model->fill($request->except(['image', 'image_path', 'slug']));

        if ($request->hasFile('image')) {
            $image = $request->image;
            $cloudinaryResponse = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            $model->image = $cloudinaryResponse;
        }

        if ($request->has('name') && $this->checkerNameSlug == true) {
            $model->slug = $this->createSlug($request->name);
        }

        if ($this->dataStoreAndUpdate($request->all())) {
            $currentDate = today();
            $model->public_date = $currentDate->format('Y-m-d');
        }
        if ($request->birthday) {
            $model->birthday = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        }

        $this->createAndUpdatePassWord($request->password);

        $model->save();
        if ($request->hasFile('image_path')) {
            $imagePaths = $request->file('image_path');
            foreach ($imagePaths as $image) {
                $cloudinaryResponse = Cloudinary::upload($image->getRealPath())->getSecurePath();
                $doctorImage = new Doctor_image();
                $doctorImage->image_path = $cloudinaryResponse;
                $doctorImage->doctor_id = $model->id;
                $doctorImage->save();
            }
        }

        $selectedServices = $request->input('service_id', []);
        $model->services()->attach($selectedServices);
        if ($this->checkRolePermission == false) {
            $model->assignRole($request->role);
        }

        return back()->with('success', 'Thao tác thành công');
    }









    public function edit(string $id)
    {
        $images = []; // Đổi tên biến này thành $images
        $doctor = Doctor::findOrFail($id);
        $doctorImages = Doctor_image::where('doctor_id', $id)->get();
        $services = Service::select('id', 'name')->get();
        $doctor->birthday = Carbon::createFromFormat('Y-m-d', $doctor->birthday)->format('d-m-Y');
        foreach ($doctorImages as $image) {
            $images[] = $image->image_path; // Thay đổi thành $images
        }

        $dataViewer = [
            'title' => $this->titleEdit,
            'colums' => $this->colums,
            'permission_crud' => $this->permissionCheckCrud
        ];
        return view('admin.doctor.edit', compact('doctor', 'services', 'images'))
            ->with($dataViewer);
    }

    public function update(Request $request, $id)
    {
        $model = Doctor::findOrFail($id);
        $validateUpdate = $this->validateUpdate($request);
        if ($validateUpdate) {
            return back()->withErrors($validateUpdate)->withInput();
        }
        $model->fill($request->except(['image', 'slug', 'image_path']));
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
        if ($request->birthday) {
            $model->birthday = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        }


        $selectedServices = $request->input('service_id', []);
        $availableServices = Service::pluck('id')->toArray(); // Lấy tất cả id của service

        $invalidServices = array_diff($selectedServices, $availableServices); // Lấy ra các id không hợp lệ
        if (count($invalidServices) > 0) {
            $errorMessage = 'Dịch vụ đã chọn không hợp lệ: ' . implode(', ', $invalidServices);
            $validServices = array_diff($selectedServices, $invalidServices);

            $errors = new MessageBag();
            $errors->add('error', $errorMessage);
            $errors->add('validServices', $validServices);

            return redirect()->back()->withErrors($errors);
        }

        $model->services()->sync($selectedServices);
        if ($this->checkRolePermission == false) {
            $model->assignRole($request->role);
        }
        $model->save();


        if ($request->hasFile('image_path')) {
            // Thêm ảnh mới vào bảng Doctor_image
            $imagePaths = $request->file('image_path');

            foreach ($imagePaths as $image) {
                $cloudinaryResponse = Cloudinary::upload($image->getRealPath())->getSecurePath();
                $doctorImage = new Doctor_image();
                $doctorImage->image_path = $cloudinaryResponse;
                $doctorImage->doctor_id = $model->id;
                $doctorImage->save();
            }
        }
        if ($request->has('deleted_image_path')) {
            $imagePaths = $request->input('deleted_image_path');
            // dd($imagePaths);
            $deleted = false; // Biến cờ để theo dõi trạng thái xóa
            if (is_array($imagePaths)) {
                foreach ($imagePaths as $imagePath) {
                    // Xóa hình ảnh từ cơ sở dữ liệu
                    $deleted = Doctor_image::where('image_path', $imagePath)->delete();

                    if (!$deleted) {
                        return back()->with('error', 'Không thể xóa hình ảnh');
                    }
                }
            } else {
                // Xóa một ảnh duy nhất từ cơ sở dữ liệu
                $deleted = Doctor_image::where('image_path', $imagePaths)->delete();

                if (!$deleted) {
                    return back()->with('error', 'Không thể xóa hình ảnh');
                }
            }

            if ($deleted) {
                // Xóa đường dẫn hình ảnh đã xóa khỏi request
                $requestData = $request->except('deleted_image_path');
                $request->replace($requestData);
            }
        } else {
            if ($request->hasFile('image_path')) {
                // Thêm ảnh mới vào bảng Doctor_image
                $imagePaths = $request->file('image_path');
                foreach ($imagePaths as $image) {
                    $cloudinaryResponse = Cloudinary::upload($image->getRealPath())->getSecurePath();
                    $doctorImage = new Doctor_image();
                    $doctorImage->image_path = $cloudinaryResponse;
                    $doctorImage->doctor_id = $model->id;
                    $doctorImage->save();
                }
            }
        }

        return back()->with('success', 'Thao tác thành công');
    }




    public function destroy(string $id)
    {
        if (auth()->user()->can(['delete-' . $this->permissionCheckCrud])) {
            $model = Doctor::findOrFail($id);


            if ($model->image) {
                Cloudinary::destroy($model->image);
            }

            // Xóa ảnh từ bảng doctor_images
            $doctorImages = Doctor_image::where('doctor_id', $id)->get();
            foreach ($doctorImages as $doctorImage) {
                if ($doctorImage->image_path) {
                    Cloudinary::destroy($doctorImage->image_path);
                }
                $doctorImage->delete();
            }

            $model->delete(); // Xóa bác sĩ

            return back()->with('success_delete', 'Đã xóa thành công');
        } else {
            return view('admin_403');
        }
    }

    public function show($id){
        $doctor = Doctor::findOrFail($id);
        $doctorImages = Doctor_image::where('doctor_id', $id)->get();
        $services = Service::select('id', 'name')->get();
        $doctor->birthday = Carbon::createFromFormat('Y-m-d', $doctor->birthday)->format('d-m-Y');
        foreach ($doctorImages as $image) {
            $images[] = $image->image_path; // Thay đổi thành $images
        }

        $dataViewer = [
            'title' => $this->titleEdit,
            'colums' => $this->colums,
            'permission_crud' => $this->permissionCheckCrud
        ];
        return view('admin.doctor.show', compact('doctor', 'services', 'doctorImages'))
            ->with($dataViewer);
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
