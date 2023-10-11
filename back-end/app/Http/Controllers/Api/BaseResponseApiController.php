<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseResponseApiController extends Controller
{
    public $model;
    public $title = '';

    public function index()
    {
        $data = $this->model->all();
        return response()->json([
            'data'=>$data
        ] , 200);
    }

    public function return404() {
        return response()->json(['message' => $this->title.'không tồn tại'], 404);
    }


}
