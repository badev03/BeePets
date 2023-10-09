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
        'content' => 'Nội dung',
        'score' => 'Rating',
        'doctor_id' => 'Bác sĩ',
        'user_id' => 'Khách hàng',
    ];

    public function index()
    {
        $data = $this->tableQuery('reviews')
            ->join('users' , 'users.id' , '=' , 'reviews.user_id')
            ->join('doctors' , 'doctors.id' , '=' , 'reviews.doctor_id')
            ->select('reviews.*' , 'users.name as user_id' , 'users.avatar' , 'doctors.name as doctor_id')
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


}
