<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ],
            [
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'password.required' => 'Vui lòng nhập mật khẩu'
            ]);
        $credentials = $request->only('phone', 'password');
        if (Auth::guard('doctors')->attempt($credentials)) {
            $doctor = Auth::guard('doctors')->user();
            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'access_token' => $doctor->createToken('auth_token')->plainTextToken,
                'token_type' => 'Bearer',
                'doctor' => $doctor
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Đăng nhập thất bại',
            ]);
        }
    }



    // lấy ra thông tin của bác sĩ  đã đăng nhập theo id
    public function getDoctor() {
        if(!Auth::guard('doctors')->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập'
            ]);
        }else{
            $doctor = Auth::guard('doctors')->user();
            return response()->json([
                'success' => true,
                'message' => 'Lấy thông tin bác sĩ thành công',
                'doctor' => $doctor
            ]);
        }

    }
    public function listCustomer()
    {
        try {
            if (Auth::guard('doctors')->user()) {
                $doctor_id = Auth::guard('doctors')->user()->id;
                $customers = Appointment::where('doctor_id', $doctor_id)
                    ->join('users', 'users.id', '=', 'appointments.user_id')
                    ->select('users.name', 'users.phone', 'users.email', 'users.address')
                    ->get();
                return response()->json([
                    'success' => true,
                    'message' => 'Lấy danh sách khách hàng thành công',
                    'customers' => $customers
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng nhập',
                ]);
            }
        }catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function getHistoryByUser($id)
    {
        if (Auth::guard('doctors')->check()) {
            $doctor_id = Auth::guard('doctors')->user()->id;
            $appointments = Appointment::where('doctor_id', $doctor_id)
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->where('appointments.user_id', $id)
                ->select('users.name', 'users.phone', 'users.email', 'users.address','appointments.date', 'appointments.time', 'appointments.status')
                ->get();
            return response()->json([
                'success' => true,
                'message' => 'Lấy danh sách khách hàng thành công',
                'appointments' => $appointments
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bạn chưa đăng nhập',
            ]);
        }
    }

  


}
