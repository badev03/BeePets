<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OtpToken;
use App\Models\User;
use App\Traits\QueryCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseResponseApiController
{
    use QueryCommon;
    public $title = 'Auth';
    public function index() {

    }

    public function checkPhone() {
        return view('api.login');
    }

    public function checkerPhone(Request $request) {
        $validator = $this->validateForm($request->all() , 'loginOtp');
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $phone_number = $request->input('phone');
        if($phone_number) {
            $check_exit_phone = $this->tableQuery('users')
                ->where('role_id' , '=' , 4)
                ->where('phone' , '=' , $phone_number)->first();
            if($check_exit_phone) {
                return response()->json(['exists' => true , 'msg' => 'Có số điện thoại'], 200);
            }
            else {
                return response()->json(['exists' => false , 'msg' => 'xin lỗi ko tồn tại số điện thoại'], 200);
            }
        }
    }

    public function LoginUserOtp(Request $request) {
        $validator = $this->validateForm($request->all() , 'loginOtp');
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $phone_number = '0981608298';
        if($phone_number) {
            $check_exit_phone = $this->tableQuery('users')
                ->where('role_id' , '=' , 4)
                ->where('phone' , '=' , $phone_number)->first();
            if($check_exit_phone) {
                return response()->json(['exists' => true , 'msg' => 'Có số điện thoại'], 200);
            }
            else {
                return response()->json(['exists' => false , 'msg' => 'xin lỗi ko tồn tại số điện thoại'], 200);
            }
        }
    }

    public function CheckVerify(Request $request) {
//        $phone_number = $request->input('phone');
        $phone_number = '0981608298';
        if($phone_number) {
            $check_exit_phone = User::where('phone', $phone_number)
                ->where('role_id' , '=' , 4)
                ->first();
//            $check_exit_phone = $this->tableQuery('users')
//                ->where('role_id' , '=' , 4)
//                ->where('phone' , '=' , $phone_number)->first();

            if($check_exit_phone) {
                Auth::login($check_exit_phone);
                $user = Auth::user();
                $token = $user->createToken('AccessToken', ['*'])->plainTextToken;
//                $token = $check_exit_phone->createToken('AccessToken')->plainTextToken;
                return response()->json([
                    'users' => $user ,
                    'token' => $token ,
                    'msg' => 'oki đi đến verify'
                ], 200);
            }
            else {
                return response()->json(['msg' => 'Xin lỗi số điện thoai của bạn không hợp lê'], 400);
            }
        }
    }

    public function CheckLogin(Request $request) {
        $validator = $this->validateForm($request->all() , 'login');
        if ($validator->fails()) {
            if($validator->errors()->has('phone') || $validator->errors()->has('password')) {
                return response()->json(
                    [
                        'phone' => $validator->errors()->first('phone') ,
                        'password' => $validator->errors()->first('password')
                    ], 400);
            }
        }
        $phone_number = $request->input('phone');
        $password = $request->input('password');
        if($phone_number && $password) {
            if (Auth::guard('web')->attempt(['phone' => $phone_number, 'password' => $password])) {
                $userToken = Auth::user();
                $token = $userToken->createToken('AccessToken', ['*'])->plainTextToken;
                $user = $this->tableQuery('users')->where('phone', '=', $phone_number)
                    ->where('role_id', '=', 4)->first();
                return response()->json(['message' => 'Đăng nhập thành công', 'user' => $userToken , 'token'=>$token], 200);
            } else {
                return response()->json(['message' => 'Bạn đã sai tài khoản hoặc mật khẩu'], 400);
            }
        }
    }

    public function LogoutUser(Request $request) {
        $request->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json('Đăng xuất thành công');
    }
    // đăng xuất bác sĩ
    public function LogoutDoctor(Request $request) {
        $request->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return response()->json('Đăng xuất thành công');
    }

    public function RegisterUser(Request $request) {
        $validator = $this->validateForm($request->all() , 'register');
        if ($validator->fails()) {
            if($validator->errors()->has('phone') || $validator->errors()->has('password')) {
                return response()->json(
                    [
                        'phone' => $validator->errors()->first('phone') ,
                    ], 400);
            }
        }
        $phone_number = $request->input('phone');
        $existingUser = $this->tableQuery('users')
            ->where('phone' , '=' , $phone_number)
            ->where('role_id' , '=' , 4)
            ->first();
        if($existingUser) {
            return response()->json(['msg' => 'Số điện thoại này đã được đăng ký'], 400);
        }
        else {
            return response()->json(['msg' => 'oki đến verify'], 200);
        }
    }

    public function validateForm($data , $case) {

        switch ($case) {
            case 'login' :
                $validator = Validator::make($data, [
                    'phone' => 'required|numeric',
                    'password' => 'required|min:6',
                ] , [
                    'phone.required' => 'Trường phone không được để trống',
                    'phone.numeric' => 'Trường phone phải là số',
                    'password.required' => 'Trường password không được để trống',
                    'password.min' => 'Trường password phải nhập ít nhất 6 ký tự',
                ]);
                break;
            case 'register':
                $validator = Validator::make($data, [
                    'phone' => 'required|numeric',
                ] , [
                    'phone.required' => 'Trường phone không được để trống',
                    'phone.numeric' => 'Trường phone phải là số',
                ]);
                break;
            case 'password_reset' :
                $validator = Validator::make($data, [
                    'phone' => 'required|numeric',
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6'
                ] , [
                    'phone.required' => 'Trường phone không được để trống',
                    'phone.numeric' => 'Trường phone phải là số',
                    'password.required' => 'Trường password không được để trống',
                    'password.min' => 'Trường password phải nhập ít nhất 6 ký tự',
                    'password_confirmation.required' => 'Trường password_confirmation không được để trống',
                    'password_confirmation.min' => 'Trường password_confirmation phải nhập ít nhất 6 ký tự',
                    'password.confirmed' => 'Trường password_confirmation không khớp với trường password xác nhận',
                ]);
                break;
            case 'loginOtp' :
                $validator = Validator::make($data, [
                    'phone' => 'required|numeric',
                ] , [
                    'phone.required' => 'Trường phone không được để trống',
                    'phone.numeric' => 'Trường phone phải là số',
                ]);
                break;
            case 'createPass':
                $validator = Validator::make($data, [
                    'password' => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6'
                ] , [
                    'password.required' => 'Trường password không được để trống',
                    'password.min' => 'Trường password phải nhập ít nhất 6 ký tự',
                    'password_confirmation.required' => 'Trường password_confirmation không được để trống',
                    'password_confirmation.min' => 'Trường password_confirmation phải nhập ít nhất 6 ký tự',
                    'password.confirmed' => 'Trường password_confirmation không khớp với trường password xác nhận',
                ]);
                break;
            default:
                $validator = Validator::make([], []);
                break;
        }
        return $validator;
    }


    public function CheckVerifyRegister(Request $request) {
        $validator = $this->validateForm($request->all() , 'register');
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $phone_number = $request->input('phone');
        $existingUser = $this->tableQuery('users')
            ->where('phone' , '=' , $phone_number)
            ->where('role_id' , '=' , 4)
            ->first();
        if($phone_number) {
            if($existingUser) {
                return response()->json(['msg' => 'Số điện thoại này đã được đăng ký'], 400);
            }
            else {
                return response()->json(['msg' => 'Đi đến tạo mật khẩu'], 200);
            }
        }
    }

    public function CreatePassword(Request $request) {
        $validator = $this->validateForm($request->all() , 'password_reset');
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $password = $request->input('password');
        $phone = $request->input('phone');
        $password_again = $request->input('password_confirmation');
        if ($password === $password_again) {
            $insert_user = $this->tableQuery('users')->insert(
                [
                    'name' => $phone,
                    'phone' => $phone,
                    'email' => $phone.'@gmail.com',
                    'password' => Hash::make($password),
                    'status' => 1,
                    'role_id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
            return response()->json(['msg' => 'Đã tạo tài khoản thành công'], 200);
        }
        elseif($password != $password_again) {
            return response()->json(['errors' => ['password_confirmation' => 'Xác nhận mật khẩu không khớp']], 400);
        }
    }

    public function ForgetPassWord(Request $request) {
        $validator = $this->validateForm($request->all() , 'register');
        if ($validator->fails()) {
            if($validator->errors()->has('phone') || $validator->errors()->has('password')) {
                return response()->json(
                    [
                        'phone' => $validator->errors()->first('phone') ,
                    ], 400);
            }
        }
        $phone_number = $request->input('phone');
        $existingUser = $this->tableQuery('users')
            ->where('phone' , '=' , $phone_number)
            ->where('role_id' , '=' , 4)
            ->first();
        if($existingUser) {
            return response()->json(['msg' => 'oki đến verify cho phép ắt đầu verify'], 200);
        }
        else {
            return response()->json(['msg' => 'Xin lỗi bạn số điên thoại không hợp lệ'], 400);
        }
    }

    public function CheckVerifyForgetPassword(Request $request) {
        $phone_number = $request->input('phone');
        if($phone_number) {
            $update_user = $this->tableQuery('users')
                ->where('phone' , '=' , $phone_number)
                ->update(
                [
                    'password' => Hash::make($phone_number),
                    'updated_at' => now(),
                ]
            );
            if($update_user) {
                $user = $this->tableQuery('users')
                    ->where('role_id' , '=' , 4)
                    ->where('phone' , '=' , $phone_number)->first();

                return response()->json([
                    'msg' => 'Đã update dữ liệu thành công hehe',
                    'users' => $user,
                ], 200);
            }
            else {
                return response()->json([
                    'msg' => 'Dữ liệu chưa được update',
                ], 400);
            }
        }
    }

    public function ResetPassword(Request $request) {
        $validator = $this->validateForm($request->all() , 'password_reset');
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $phone_number = $request->input('phone');
        $password = $request->input('password');
        if($phone_number) {
            $update_user = $this->tableQuery('users')
                ->where('phone' , '=' , $phone_number)
                ->update(
                    [
                        'password' => Hash::make($password),
                        'updated_at' => now(),
                    ]
                );
            if($update_user) {
                $user = $this->tableQuery('users')
                    ->where('role_id' , '=' , 4)
                    ->where('phone' , '=' , $phone_number)->first();
                return response()->json([
                    'msg' => 'Đã update dữ liệu thành công hehe',
                    'users' => $user,
                ], 200);
            }
            else {
                return response()->json([
                    'msg' => 'Dữ liệu chưa được update',
                ], 400);
            }
        }
    }
}
