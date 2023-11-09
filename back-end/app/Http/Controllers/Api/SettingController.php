<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\QueryCommon;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use QueryCommon;
    public function index() {
        $setting = $this->tableQuery('settings')->first();
        if (!$setting) {
            return response()->json(['msg'=> 'Không có dữ liệu'] , 400);
        }
        else {
            return response()->json(['msg'=> 'Đã có dữ liệu' , 'setting'=>$setting] , 200);
        }
    }
}
