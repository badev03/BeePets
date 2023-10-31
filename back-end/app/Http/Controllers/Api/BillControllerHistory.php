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
            $bill = Bill::where('bills.doctor_id', '=', \auth()->id())
                ->join('doctors', 'doctors.id', '=', 'bills.doctor_id')
                ->join('appointments', 'appointments.id', '=', 'bills.appointment_id')
                ->join('users', 'users.id', '=', 'bills.user_id')
                ->join('services', 'services.id', '=', 'bills.service_id')
                ->select(
                    'bills.id',
                    'bills.code',
                    'bills.description',
                    \DB::raw('COALESCE(bills.customer_name, users.name) as customer_name'),
                    \DB::raw('COALESCE(bills.customer_phone, users.phone) as customer_phone'),
                    'bills.discount',
                    'bills.total_amount',
                    'bills.status',
                    'bills.payment_method',
                    'bills.transaction_type',
                    'bills.user_id',
                    'bills.service_id',
                    'bills.appointment_id',
                    'bills.promotion_id',
                    'bills.doctor_id',
                    'doctors.name as doctor_name',
                    'appointments.date',
                    'appointments.shift_name',
                    'users.avatar',
                    'services.name as service_name',
                )
                ->whereIn('bills.status', [6, 3])
                ->orderBy('bills.created_at', 'desc')
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
