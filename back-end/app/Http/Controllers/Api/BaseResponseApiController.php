<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseResponseApiController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = app()->make($this->model);
    }

    public function index()
    {
        $data = $this->model->all();
        return response()->json([
            'data'=>$data
        ] , 200);
    }
}
