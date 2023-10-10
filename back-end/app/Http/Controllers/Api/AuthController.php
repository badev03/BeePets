<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $SMS_PHONE = 'Your username';

    public function index() {

    }

    public function Login(Request $request) {
        $phone_number = $request->input('phone');

        $message = "A message has been sent to you";

        $this->initiateSmsActivation($phone_number, $message);

        return redirect()->back()->with('message', 'Message has been sent successfully');
    }

    public function register(Request $request) {
        $phone_number = $request->input('phone');

    }
}
