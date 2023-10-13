<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getInfoUser() {
        try {
            if(auth()->check()) {
                $user = auth()->user();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy thông tin người dùng thành công',
                    'user' => $user
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            }
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi'
            ]);
        }
    }
    public function changePasswordUser(Request $request) {
        try {
            if(auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            }else{
                $user = auth()->user();
                $request->validate([
                    'password' => 'required',
                    'new_password' => 'required',
                    'confirm_password' => 'required|same:new_password'
                ],
                    [
                        'password.required' => 'Vui lòng nhập mật khẩu',
                        'new_password.required' => 'Vui lòng nhập mật khẩu mới',
                        'confirm_password.required' => 'Vui lòng nhập lại mật khẩu mới',
                        'confirm_password.same' => 'Mật khẩu nhập lại không chính xác'
                    ]);
                if(!Hash::check($request->password, $user->password)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Mật khẩu không chính xác'
                    ]);
                }else{
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return response()->json([
                        'success' => true,
                        'message' => 'Đổi mật khẩu thành công'
                    ]);
                }
            }
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi'
            ]);
        }
    }
    public function logoutUser() {
        try {
            if(!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            }else{
                auth()->logout();
                return response()->json([
                    'success' => true,
                    'message' => 'Đăng xuất thành công'
                ]);
            }
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi'
            ]);
        }
    }
    //get all appointment by user
    public function getAppiontment() {
        try {
            if(!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            }else{
                $id = auth()->user()->id;
                $result = DB::table('appointments')
                    ->select('doctors.name as doctor_name', 'appointments.date', 'appointments.time', 'appointments.status', 'appointments.id as appointment_id')
                    ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                    ->where('appointments.user_id', $id)
                    ->get();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy danh sách lịch khám thành công',
                    'appointments' => $result
                ]);
            }
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi'
            ]);
        }
    }
    public function prescriptionByUser() {
        try {
            if(!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            }else{
                $id = auth()->user()->id;
                $result = DB::table('prescriptions')
                    ->select('prescriptions.created_at as prescription_created_at', 'doctors.name as doctor_name', 'prescriptions.name as prescription_name')
                    ->join('bills', 'bills.prescription_id', '=', 'prescriptions.id')
                    ->join('appointments', 'appointments.id', '=', 'bills.appointment_id')
                    ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                    ->where('appointments.user_id', $id)
                    ->get();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy danh sách đơn thuốc thành công',
                    'prescriptions' => $result
                ]);
            }
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi'
            ]);
        }
    }
    public function billByUser() {
        try {
            if(!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập'
                ]);
            }else{
                $id = auth()->user()->id;
                $result = DB::table('bills')
                    ->select('bills.code as bill_code', 'bills.created_at as bill_created_at', 'doctors.name as doctor_name', 'bills.total_amount')
                    ->join('appointments', 'appointments.id', '=', 'bills.appointment_id')
                    ->join('doctors', 'doctors.id', '=', 'appointments.doctor_id')
                    ->where('appointments.user_id', $id)
                    ->get();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy danh sách hóa đơn thành công',
                    'bills' => $result
                ]);
            }

        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi'
            ]);
        }
    }
}
