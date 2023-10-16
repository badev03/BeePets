<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminNotification;
use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Interfaces\MessageUser;
use App\Models\Notification;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;
class HomeController extends Controller
{
    public function index() {
        return view('admin.dashboard.dashboard');
    }

    public function uploadImg(Request $request) {
        if($request->has('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName , PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName .'_'.time().'_'.$extension;
            $request->file('upload')->move(public_path('media') , $fileName);
            $url = asset('media/'. $fileName);
            return response()->json([
                'fileName' => $fileName , 'uploaded' => 1, 'url' => $url
            ]);
        }
    }

    public function upload(Request $request) {
        $uploadedFileUrl = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
    }

    public function Pusher() {
        $userId = 3;

        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);

        $data = ['message' => 'Đây là thông báo mất kỳ. le huy dat test'];

        // Gửi thông báo đến kênh riêng của người dùng
        $pusher->trigger("private-user-3", 'notification-event', $data);
        Notification::create([
            'user_id' => $userId,
            'message' => $data['message'],
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }


    public function SendNotification(Request $request) {
        $user_id = $request->input('user_id');
        $message = $request->input('message');
        Notification::create([
            'user_id' => $user_id,
            'message' => $message,
        ]);
        $userId = 3;

        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);

        $data = ['message' => $message , 'now' => now()];

        $pusher->trigger("user-notification-$userId", 'notification-event', $data);
        return response()->json(
            ['msg' => 'đã gửi thông báo thành công']
        , 200);
    }

    public function PusherView() {
        return view('api.pusher');
    }

    public function PusherView2() {
        return view('api.pusher_2');
    }

    public function pusherApi(MessageUser $messageService) {
        $messageService->sendMessage(3, 'Vũ anh bá');
    }
}
