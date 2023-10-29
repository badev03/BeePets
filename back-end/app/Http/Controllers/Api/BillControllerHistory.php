<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillControllerHistory extends Controller
{
    public function index() {
        if (Auth::guard('doctors')) {
//            $appointment =
            dd(\auth()->id());
        }
    }

    public function billHistory() {
        if (Auth::guard('doctors')) {
            $bill = Bill::where('doctor_id' , '=' , \auth()->id())
                ->whereIn('status', [6, 3])
                ->get();
            if(!$bill->isEmpty()) {
                return response()->json([
                    'bill' => $bill,
                    'msg' => 'Đã trả về dữ liệu'
                ] , 200);
            }
            else {
                return response()->json([
                    'msg' => 'Không có dữ liệu'
                ] , 200);
            }
        }
        else {
            return response()->json([
                'msg' => 'Bạn có có quyền truy cập'
            ] , 401);
        }
    }
}
