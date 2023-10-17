<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.users.login');
    }

    public function checkLogin(Request $rq)
    {
        $credentials = [
            'email' => $rq->email,
            'password' => $rq->password,
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard');
        } else {
            return back()->with(['msg' => 'Sai Email hoặc Password']);
        }
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function login()
    {
        return view('client.login');
    }
    public function loginPost(Request $request)
    {
        $request->validate(
            [
                'phone' => 'required',
                'password' => 'required',
            ],
            [
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'password.required' => 'Vui lòng nhập mật khẩu',
            ]
        );

        $credentials = $request->only('phone', 'password');
        if (Auth::attempt($credentials)) {
            if(Auth::user()->role_id == 4){
                return redirect()->route('index');
            }

        } else {
            return back()->with(['msg' => 'Sai Email hoặc Password']);
        }


    }

    public function formLogout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
