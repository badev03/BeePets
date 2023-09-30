<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function index() {
        return view('admin.users.login');
    }

    public function checkLogin(Request $rq) {
        $credentials = [
            'email' => $rq->email,
            'password' => $rq->password,
        ];
        if(Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard');
        }
        else {
            return back()->with(['msg'=>'Sai Email hoặc Password']);
        }

    }

    public function logOut() {
        Auth::logout();
        return redirect()->route('admin.login');
    }


}
