<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use http\Exception\BadConversionException;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public $path_view = 'admin.setting.';

    public $title = 'Cấu hình';
    public function index(Request $request) {
        $data_first = Setting::first();
        if ($request->isMethod('GET')) {
            return view($this->path_view.'index' , compact('data_first'));
        }
        else {
            $this->validate($request, [
                'address' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'description' => 'required',
            ], [
                'address.required' => 'Địa chỉ không được để trống',
                'phone.required' => 'Số điện thoại không được để trống',
                'email.required' => 'Email không được để trống',
                'description.required' => 'Mô tả không được để trống',
            ]);
            $data = [];
            if($request->has('image_header')) {
                $image = $request->image_header;
                $cloudinaryResponse = Cloudinary::upload($image->getPathname());
                $cloudinaryUrl = $cloudinaryResponse->getSecurePath();

                $data['image_header'] = $cloudinaryUrl;
            }
            elseif ($request->has('image_footer')){
                $image = $request->image_footer;
                $cloudinaryResponse = Cloudinary::upload($image->getPathname());
                $cloudinaryUrl = $cloudinaryResponse->getSecurePath();
                $data['image_footer'] = $cloudinaryUrl;
            }
            $data_first->update(array_merge($request->except(['_token', '_method']) , $data));
            return back()->with(['success'=>'Đã update dữ liệu thành công']);
        }
    }
}
