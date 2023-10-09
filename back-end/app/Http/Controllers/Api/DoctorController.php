<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ],
        [
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'password.required' => 'Vui lòng nhập mật khẩu'
        ]);
        $credentials = $request->only('phone', 'password');
        if(Auth::guard('doctors')->attempt($credentials)) {
            $doctor = Auth::guard('doctors')->user();
            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'doctor' => $doctor
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Đăng nhập thất bại',
            ]);
        }
    }
}