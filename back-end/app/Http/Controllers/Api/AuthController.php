<?php

namespace App\Http\Controllers\Api;

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

    public function checkerPhone(Request $request) {
        $validator = $this->validateForm($request->all() , 'register');
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $phone_number = $request->input('phone');
        if($phone_number) {
            $check_exit_phone = $this->checkPhone($phone_number);
            if($check_exit_phone) {
                return response()->json(['exists' => true , 'msg' => 'Có số điện thoại'], 200);
            }
            else {
                return response()->json(['exists' => false , 'msg' => 'xin lỗi ko tồn tại số điện thoại'], 400);
            }
        }
        return response()->json(['msg'=>'bạn phải nhập số điện thoại'], 400);
    }

    public function LoginUserOtp(Request $request) {
        $validator = $this->validateForm($request->all() , 'register');
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $phone_number = '0981608298';
        if($phone_number) {
            $check_exit_phone = $this->checkPhone($phone_number);
            if($check_exit_phone) {
                return response()->json(['exists' => true , 'msg' => 'Có số điện thoại'], 200);
            }
            else {
                return response()->json(['exists' => false , 'msg' => 'xin lỗi ko tồn tại số điện thoại'], 400);
            }
        }
    }

    public function CheckVerify(Request $request) {
        $phone_number = $request->input('phone');
        if($phone_number) {
            $check_exit_phone = $this->checkPhone($phone_number);
            if($check_exit_phone) {
                Auth::login($check_exit_phone);
                $user = Auth::user();
                $token = $user->createToken('AccessToken', ['*'])->plainTextToken;
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
                $user = $this->checkPhone($phone_number);
                return response()->json(['message' => 'Đăng nhập thành công', 'user' => $userToken , 'token'=>$token], 200);
            } else {
                return response()->json(['message' => 'Bạn đã sai tài khoản hoặc mật khẩu'], 400);
            }
        }
    }

    public function LogoutUser(Request $request) {
        if (auth()->guard('doctors')->check()) {
            $doctor = auth()->guard('doctors')->user();
            $doctor->currentAccessToken()->delete();
        } elseif (auth()->check()) {
            $user =auth()->user();
            $user->currentAccessToken()->delete();
        } else {
            return response()->json('Unauthorized', 401);
        }
        return response()->json(['message' => 'Đăng xuất thành công' , 'data'=>$request->all()], 200);
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
        $existingUser = $this->checkPhone($phone_number);
        if($existingUser) {
            return response()->json(['msg' => 'Số điện thoại này đã được đăng ký'], 400);
        }
        else {
            return response()->json(['msg' => 'oki đến verify'], 200);
        }
    }


    public function CheckVerifyRegister(Request $request) {
        $validator = $this->validateForm($request->all() , 'register');
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $phone_number = $request->input('phone');
        $existingUser = $this->checkPhone($phone_number);
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
        $validator = $this->validateForm($request->all() , 'login');
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $password = $request->input('password');
        $phoneNumber = $request->input('phone');
        $existingUser = $this->checkPhone($phoneNumber);
            if($existingUser) {
                return response()->json(['msg' => 'Số điện thoại này đã tồn tại'] , 400);
            }
            else {
                $this->tableQuery('users')->insert([
                    'name' => $phoneNumber,
                    'email' => $phoneNumber.'@gmail.com',
                    'password' => Hash::make($password),
                    'role_id' => 4,
                    'status' => 1,
                    'phone' => $phoneNumber,
                ]);
            return response()->json(['msg' => 'Đã tạo tài khoản thành công'], 200);
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
        $existingUser = $this->checkPhone($phone_number);
        if($existingUser) {
            return response()->json(['msg' => 'Đến Đặt lại mật khẩu'], 200);
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
                $user = $this->checkPhone($phone_number);

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

    public function ResetPassword(Request $request , $phone_number) {
        $validator = $this->validateForm($request->all() , 'password_reset');
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
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
                $user = $this->checkPhone($phone_number);
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



    public function ChangePassword(Request $request , $phone) {
        $validator = $this->validateForm($request->all() , 'change_password');
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $existingUser = $this->checkPhone($phone);
        $password = $request->input('new_password');
        $password_again = $request->input('password_confirmation');
        if($existingUser) {
            if (password_verify($request->input('old_password'), $existingUser->password)) {
                if($password === $password_again) {
                    $update_user = $this->tableQuery('users')
                        ->where('phone' , '=' , $phone)
                        ->update(
                            [
                                'password' => Hash::make($password),
                                'updated_at' => now(),
                            ]
                        );
                    return response()->json(['msg' => 'Đổi mật khẩu thành công'], 200);
                }
                else {
                    return response()->json(['msg' => 'Mật khẩu hiện tại không chính xác'], 400);
                }
            } else {
                return response()->json(['msg' => 'Mật khẩu hiện tại không chính xác'], 400);
            }
        }

        else {
            return response()->json(['msg' => 'Số điện thoại không chính xác'], 200);
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
            case 'change_password' :
                $validator = Validator::make($data, [
                    'old_password' => 'required|min:6',
                    'new_password' => 'required|min:6',
                    'password_confirmation' => 'required|same:new_password',
                ] , [
                    'new_password.required' => 'Trường password không được để trống',
                    'old_password.required' => 'Trường password không được để trống',
                    'new_password.min' => 'Trường password phải nhập ít nhất 6 ký tự',
                    'old_password.min' => 'Trường password phải nhập ít nhất 6 ký tự',
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


    public function ForGetPasswordUser(Request $request , $phone) {
        $validator = $this->validateForm($request->all() , 'createPass');
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $existingUser = $this->checkPhone($phone);
        $password = $request->input('password');
        $password_again = $request->input('password_confirmation');
        if ($existingUser) {
            if ($password === $password_again) {
                // Đặt mật khẩu mới và cập nhật ngày cập nhật
                $update_user = $this->tableQuery('users')
                    ->where('phone', '=', $phone)
                    ->update([
                        'password' => Hash::make($password),
                        'updated_at' => now(),
                    ]);

                return response()->json(['msg' => 'Đặt mật khẩu mới thành công'], 200);
            } else {
                return response()->json(['msg' => 'Xác nhận mật khẩu không khớp'], 400);
            }
        } else {
            return response()->json(['msg' => 'Số điện thoại không chính xác'], 400);
        }
    }
}
