<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends BaseResponseApiController
{
    public $model = Service::class;

    public function showHome() {
        $data = Service::limit(4)->get();
        return response()->json([
            'data' => $data],
            '200');
    }
}
