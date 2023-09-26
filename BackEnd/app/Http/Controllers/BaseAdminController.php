<?php

namespace App\Http\Controllers;

use Illuminat\Database\Eloquent\Builder;
use Eloquent;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BaseAdminController extends Controller
{

     /**
     * @var \Illuminate\Database\Eloquent\Builder $model
     */
    public $model;
    public $pathView;
    public $urlbase;
    public $fieldImage;
    public $folderImage;
    public $colums = [];
    public $titleIndex;
    public $titleCreate;
    public $titleShow;
    public $titleEdit;
    public $slug;
    protected $title;
    protected $tester;

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
            ->with('title_web', $this->title);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->pathView . __FUNCTION__)
            ->with('title', $this->titleCreate)
            ->with('colums', $this->colums)
            ->with('urlbase', $this->urlbase)
            ->with('title_web', $this->title);
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
        if($request->has('name')) {
            $model->slug = $this->createSlug($request->name);
        }
        $model->save();

        return back()->with('success', 'Thao tac thanh cong');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = $this->model->findOrFail($id);

        return view($this->pathView . __FUNCTION__, compact('model'))
            ->with('title', $this->titleShow)
            ->with('colums', $this->colums)
            ->with('urlbase', $this->urlbase);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = $this->model->findOrFail($id);

        return view($this->pathView . __FUNCTION__, compact('model'))
            ->with('title', $this->titleEdit)
            ->with('colums', $this->colums)
            ->with('urlbase', $this->urlbase);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $this->validateUpdate($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $model = $this->model->findOrFail($id);

        $model->fill($request->except([$this->fieldImage]));

        if ($request->hasFile($this->fieldImage)) {
            $oldImage = $model->{$this->fieldImage};

            $tmpPath = Storage::put($this->folderImage, $request->{$this->fieldImage});

            $model->{$this->fieldImage} = 'storage/' . $tmpPath;
        }

        $model->save();

        if ($request->hasFile($this->fieldImage)) {
            $oldImage = str_replace('storage/', '', $oldImage);
            Storage::delete($oldImage);
        }

        return back()->with('success', 'Thao tac thanh cong');
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
        return [];
    }

    public function validateUpdate($request)
    {
        return [];
    }
}



