<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminat\Database\Eloquent\Builder;
use Eloquent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BaseAdminController extends Controller
{

    /**
     * @var \Illuminate\Database\Eloquent\Builder $model
     */
    public $model;
    public $pathView = 'admin.baseCrud.';
    public $urlbase;
    public $fieldImage='image';
    public $folderImage;
    public $colums = [];
    public $titleIndex;
    public $titleCreate;
    public $titleShow;
    public $titleEdit;
    public $slug;
    protected $title;
    protected $tester;
    protected $checkerNameSlug=true;
    protected $removeColumns= [];
    protected $FIELD_SELECT_CUSTOM_CONTROLLER = [];
    public $listIndex = [];
    protected $checkRolePermission = true;
    protected $checkerReturnView = true;
    protected $addForDataViewer = [];
    protected $permissionCheckCrud = '';
    private $teseterr = '111';
    protected $special = [];

    public function __construct()
    {
        $this->model = app()->make($this->model);
    }

    public function index()
    {
        if (auth()->user()->can(['read-'.$this->permissionCheckCrud])) {
            if(empty($this->QuerySpecialIndex())) {
                foreach ($this->colums as $key => $value) {
                    $selectedColumns[] = $key;
                }
                $selectedColumns = '`' . implode('`,`', $selectedColumns) . '`';
                $data = $this->model->select('id', DB::raw($selectedColumns))
                    ->get();
                if($this->removeColumns) {
                    $this->colums = array_diff_key($this->colums, array_flip($this->removeColumns));
                }
            }
            else{
                $data = $this->QuerySpecialIndex();
            }
            return view($this->pathView . __FUNCTION__, compact('data'))
                ->with('title', $this->titleIndex)
                ->with('colums', $this->colums)
                ->with('urlbase', $this->urlbase)
                ->with('title_web', $this->title)
                ->with('FIELD_SELECT_CUSTOM_CONTROLLER', $this->FIELD_SELECT_CUSTOM_CONTROLLER)
                ->with('special', $this->special)
                ->with('permission_crud', $this->permissionCheckCrud)
                ->with('listIndex', $this->listIndex);
        }
        else {
            return view(admin_403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can(['create-'.$this->permissionCheckCrud])) {
            if(auth()->user()->hasPermissionTo('create-service')) {
                $dataSelect = $this->addDataSelect();
                $dataViewer = [
                    'title' => $this->titleCreate,
                    'colums' => $this->colums,
                    'urlbase' => $this->urlbase,
                    'title_web' => $this->title,
                    'dataSelect' => $dataSelect,
                    'FIELD_SELECT_CUSTOM_CONTROLLER' => $this->FIELD_SELECT_CUSTOM_CONTROLLER,
                    'permission_crud'=> $this->permissionCheckCrud
                ];
                if($this->checkerReturnView === true) {
                    return view($this->pathView . __FUNCTION__)
                        ->with(array_merge($dataViewer, $this->addForDataViewer));
                }
                else {
                    $this->addFunctionData();
                    return view($this->pathView . __FUNCTION__)
                        ->with(array_merge($dataViewer, $this->addForDataViewer));
                }
            }
        } else {
            return view(admin_403);
        }

    }


    public function createSlug($name) {
        return Str::slug($name);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = new $this->model;
        $validateStore = $this->validateStore($request);
        if($validateStore) {
            return back()->withErrors($validateStore)->withInput();
        }
        $model->fill($request->except([$this->fieldImage,$this->slug]));
        if ($request->hasFile($this->fieldImage)) {
//            $tmpPath = Storage::put('public/'.$this->folderImage, $request->{$this->fieldImage});
//            $path = str_replace('public/','',  $tmpPath);
//            $model->{$this->fieldImage} = 'storage/' . $path;
            $image = $request->{$this->fieldImage};
            $cloudinaryResponse = Cloudinary::upload($request->file($this->fieldImage)->getRealPath())->getSecurePath();

            $model->{$this->fieldImage} = $cloudinaryResponse;
        }
        if($request->has('name') && $this->checkerNameSlug == true) {
            $model->slug = $this->createSlug($request->name);
        }
        $dataModel = $request->all();
        if($this->dataStoreAndUpdate($dataModel)) {
            $currentDate = today();
            $model->public_date =$currentDate->format('Y-m-d');
        }
        $this->createAndUpdatePassWord($request->password);
        $model->save();
        if($this->checkRolePermission==false) {
            $model->assignRole($request->role);
        }

        if ($this->permissionCheckCrud === 'PeopleAccount') {
            $model->assignRole($request->role_id);
        }

        return back()->with('success', 'Thao tác thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = $this->model->findOrFail($id);

        return response()->json($model);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = $this->model->findOrFail($id);
        $addDataSelect = $this->addDataSelect();
        $dataViewer = [
            'title' => $this->titleEdit,
            'colums' => $this->colums,
            'urlbase' => $this->urlbase,
            'title_web' => $this->title,
            'addDataSelect' => $addDataSelect,
            'listIndex' => $this->listIndex,
            'FIELD_SELECT_CUSTOM_CONTROLLER' => $this->FIELD_SELECT_CUSTOM_CONTROLLER,
            'permission_crud'=> $this->permissionCheckCrud
        ];
        if($this->checkerReturnView === true) {
            return view($this->pathView . __FUNCTION__, compact('model'))
                ->with($dataViewer);
        }
        else {
            $this->addFunctionDataEdit($id);
            if($this->permissionCheckCrud === 'permission') {
                $permission = Permission::findByName($model->name);
                $permissionWasCheck = $permission->roles->pluck('name')->toArray();
                $permissionArray = [
                    'permissionWasCheck' => $permissionWasCheck
                ];
                return view($this->pathView . __FUNCTION__, compact('model'))
                    ->with(array_merge($dataViewer, $this->addForDataViewer ,$permissionArray));
            }
            else {
                return view($this->pathView . __FUNCTION__, compact('model'))
                    ->with(array_merge($dataViewer, $this->addForDataViewer));
            }
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (auth()->user()->can(['update-'.$this->permissionCheckCrud])) {
            $model = $this->model->findOrFail($id);
            if ($model->avatar || $model->image) {
                $this->removeColumns = ['image', 'avatar'];
            }
            $validator = $this->validateStore($request);
            if ($validator) {
                return back()->withErrors($validator)->withInput();
            }


            $check = $model->fill($request->except([$this->fieldImage]));

            if ($request->hasFile($this->fieldImage)) {
                $oldImage = $model->{$this->fieldImage};

//                $tmpPath = Storage::put('public/' . $this->folderImage, $request->{$this->fieldImage});
//                $path = str_replace('public/', '', $tmpPath);
//                $model->{$this->fieldImage} = 'storage/' . $path;

                $image = $request->{$this->fieldImage};
                $cloudinaryResponse = Cloudinary::upload($request->file($this->fieldImage)->getRealPath())->getSecurePath();
                $model->{$this->fieldImage} = $cloudinaryResponse;

//                Cloudinary::destroy($oldImage);
            }
            if ($request->has('name') && $this->checkerNameSlug == true) {
                $model->slug = $this->createSlug($request->name);
            }
            $this->createAndUpdatePassWord($request->password);
            $model->save();

            if ($request->hasFile($this->fieldImage)) {
//                $oldImage = str_replace('storage/', '', $oldImage);
//                Storage::delete($oldImage);

                $oldImage = $model->{$this->fieldImage};

                // Tải lên hình ảnh lên Cloudinary và nhận URL
                $image = $request->{$this->fieldImage};
                $cloudinaryResponse = Cloudinary::upload($image->getPathname());
                $cloudinaryUrl = $cloudinaryResponse->getSecurePath();

                $model->{$this->fieldImage} = $cloudinaryUrl;
            }

            if ($this->permissionCheckCrud === 'PeopleAccount') {
                $role = Role::where('id', $request->role_id)->first();
                $user = User::find($id);
                User::find($id)->syncPermissions($request->permissions);
                $user->syncRoles([$role]);
            }

            return back()->with('success', 'Thao tác thành công');
        }
        else {
            return view(admin_403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->can(['delete-'.$this->permissionCheckCrud])) {
            $model = $this->model->findOrFail($id);

            $model->delete();
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

    public function import()
    {
        return back()->with('success_delete', 'Đã xóa thành công');
    }

    public function export()
    {

    }

    public function validateStore($request , $id = null)
    {
        $rules = [];
        $keyForErrorMessage = [];
        foreach ($this->colums as $key=>$item) {
            $rules[$key] = 'required';
        }
        if($this->removeColumns) {
            $rules = array_diff_key($rules, array_flip($this->removeColumns));
        }
        foreach ($rules as $keyForError=>$value) {
            $keyForErrorMessage[$keyForError.'.required'] = 'Trường '.$keyForError.' không được để trống';
        }
        $this->validate($request, $rules, $keyForErrorMessage);
    }

    public function validateUpdate($request)
    {
        return [];
    }

    public function addDataSelect() {

    }

    public function givePermission() {

    }

    public function addFunctionData() {

    }

    public function addFunctionDataEdit($id) {

    }

    public function selectDataIndex() {

    }

    public function checkPermissionsAndRole() {
        if($this->permissionCheckCrud === 'permission') {

        }
    }

    public function createAndUpdatePassWord($password) {
        if($password) {
            $password = Hash::make($password);
            return $password;
        }
    }

    public function QuerySpecialIndex() {

    }

    public function dataStoreAndUpdate($data) {

    }


}


