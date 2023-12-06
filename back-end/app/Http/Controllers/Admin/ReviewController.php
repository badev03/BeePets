<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Traits\QueryCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends BaseAdminController
{
    use QueryCommon;
    public $model = Review::class;
    public $urlbase = 'reviews.';
    public $folderImage = 'image/reviews';
    protected $title = 'Đánh giá';
    protected $permissionCheckCrud = 'reviews';
    public $pathView = 'admin.reviews.';

    public $colums = [
        'name' => 'Tên',
        'score' => 'Rating',
        'doctor_id' => 'Bác sĩ',
        'status' => 'Trạng thái'
    ];

    public function query() {
        $data = $this->tableQuery('reviews')
            ->join('users' , 'users.id' , '=' , 'reviews.user_id')
            ->join('doctors' , 'doctors.id' , '=' , 'reviews.doctor_id')
            ->select('reviews.*' , 'users.name as user_id' , 'users.avatar' , 'doctors.name as doctor_id'
                , 'doctors.image as doctor_image')
            ->orderBy('reviews.id' , 'DESC')
            ->where('is_trash' , null);
        return $data;
    }
    public function index()
    {
        try {
            $data = $this->query()
                ->get();
            $dataViewer = [
                'title' => $this->titleEdit,
                'colums' => $this->colums,
                'urlbase' => $this->urlbase,
                'title_web' => $this->title,
                'listIndex' => $this->listIndex,
                'permission_crud' => $this->permissionCheckCrud,
                'FIELD_SELECT_CUSTOM_CONTROLLER' => $this->FIELD_SELECT_CUSTOM_CONTROLLER,
            ];
            return view($this->pathView.__FUNCTION__ , compact('data'))->with($dataViewer);
        }
        catch (\Throwable $exception) {
            return view(admin_500);
        }
    }

    public function show(string $id)
    {
        try {
            $model = $this->query()
                ->where('reviews.id' , $id)
                ->first();
            $dataViewer = [
                'title' => $this->titleEdit,
                'colums' => $this->colums,
                'urlbase' => $this->urlbase,
                'title_web' => $this->title,
                'listIndex' => $this->listIndex,
                'permission_crud' => $this->permissionCheckCrud,
                'FIELD_SELECT_CUSTOM_CONTROLLER' => $this->FIELD_SELECT_CUSTOM_CONTROLLER,
            ];
            return view($this->pathView.__FUNCTION__ , compact('model'))->with($dataViewer);
        }
        catch (\Throwable $exception) {
            return view(admin_500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $model = $this->tableQuery('reviews')
                ->where('reviews.id' , $id)
                ->update(['status' => $request->status]);
            return back()->with(['success' => 'Thao tác thành công']);
        }
        catch (\Throwable $exception) {
            return back()->with(['fails' => 'Thao tác thất bại']);
        }
    }

    public function destroy(string $id)
    {
        try {
            $model = $this->tableQuery('reviews')
                ->where('reviews.id' , $id)
                ->update(['is_trash' => 1]);
            return back()->with(['success' => 'Thao tác thành công']);
        }
        catch (\Throwable $exception) {
            return back()->with(['fails' => 'Thao tác thất bại']);
        }
    }


}
