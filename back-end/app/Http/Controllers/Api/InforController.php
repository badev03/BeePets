<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class InforController extends Controller
{

    // lưu thông tin tài khoản của user
    public function saveInfor(Request $request)
    {
        if (auth()->check()) {
            $user = Auth::user();
    
            // Kiểm tra và cập nhật các trường nếu chúng đã thay đổi
            if ($request->filled('name') && $user->name !== $request->name) {
                $user->name = $request->name;
            }
            if ($request->filled('address') && $user->address !== $request->address) {
                $user->address = $request->address;
            }
            if ($request->filled('email') && $user->email !== $request->email) {
                if (User::where('email', $request->email)->where('id', '!=', $user->id)->exists()) {
                    return response()->json(['error' => 'Số điện thoại là duy nhất'], 422);
                }
                $user->email = $request->email;
            }
            if ($request->filled('gender') && $user->gender !== $request->gender) {
                $user->gender = $request->gender;
            }
            if ($request->filled('phone') && $user->phone !== $request->phone) {
                if (User::where('phone', $request->phone)->where('id', '!=', $user->id)->exists()) {
                    return response()->json(['error' => 'Số điện thoại là duy nhất'], 422);
                }
                $user->phone = $request->phone;
            }
            
            if($request->hasFile('avatar')){
                $file = $request->file('avatar');
                $cloudinaryResponse = Cloudinary::upload($file->getRealPath())->getSecurePath();
                $user->avatar = $cloudinaryResponse;
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Chưa có ảnh'
                ], 404);
            }
            // Lưu thông tin sau khi cập nhật
            $user->save();
    
            return response()->json([
                'status' => true,
                'user' => $user
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Chưa đăng nhập'
            ], 404);
        }
    }
    
    

   
}
