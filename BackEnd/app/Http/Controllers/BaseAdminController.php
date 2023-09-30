<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminat\Database\Eloquent\Builder;
use Eloquent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

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
    protected $checkRolePermission = '';
    protected $checkerReturnView = true;
    protected $addForDataViewer = [];
    protected $permissionCheckCrud = '';
    private $teseterr = '111';

    public function __construct()
    {
        $this->model = app()->make($this->model);
    }

    public function index()
    {
        $data = $this->model->all();
        return view($this->pathView . __FUNCTION__, compact('data'))
            ->with('title', $this->titleIndex)
            ->with('colums', $this->colums)
            ->with('urlbase', $this->urlbase)
            ->with('title_web', $this->title)
            ->with('listIndex', $this->listIndex);
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
            $tmpPath = Storage::put('public/'.$this->folderImage, $request->{$this->fieldImage});
            $path = str_replace('public/','',  $tmpPath);
            $model->{$this->fieldImage} = 'storage/' . $path;
        }
        if($request->has('name') && $this->checkerNameSlug == true) {
            $model->slug = $this->createSlug($request->name);
        }
        $model->save();
        if($this->checkRolePermission==false) {
            $model->assignRole($request->role);
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
        ];
        if($this->checkerReturnView === true) {
            return view($this->pathView . __FUNCTION__, compact('model'))
                ->with($dataViewer);
        }
        else {
            $this->addFunctionDataEdit($id);
            return view($this->pathView . __FUNCTION__, compact('model'))
                ->with(array_merge($dataViewer, $this->addForDataViewer));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $this->validateUpdate($request);

        if ($validator) {
            return back()->withErrors($validator)->withInput();
        }

        $model = $this->model->findOrFail($id);

        $model->fill($request->except([$this->fieldImage]));

        if ($request->hasFile($this->fieldImage)) {
            $oldImage = $model->{$this->fieldImage};

            $tmpPath = Storage::put('public/'.$this->folderImage, $request->{$this->fieldImage});
            $path = str_replace('public/','',  $tmpPath);
            $model->{$this->fieldImage} = 'storage/' . $path;
        }

        $model->save();

        if ($request->hasFile($this->fieldImage)) {
            $oldImage = str_replace('storage/', '', $oldImage);
            Storage::delete($oldImage);
        }

        if($this->checkRolePermission==='role') {
            $model->assignRole($request->role);
        }
        else {
            User::find($id)->syncPermissions($request->permissions);
        }

        return back()->with('success', 'Thao tác thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = $this->model->findOrFail($id);

        $model->delete();
        if($model->image) {
            $image = str_replace('storage/', '', $model->{$this->fieldImage});
            Storage::delete($image);
        }
        return back()->with('success_delete', 'Đã xóa thành công');
    }

    public function import()
    {
        return back()->with('success_delete', 'Đã xóa thành công');
    }

    public function export()
    {

    }

    public function validateStore($request)
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
}



