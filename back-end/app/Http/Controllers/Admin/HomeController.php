<?php

namespace App\Http\Controllers\Admin;

use App\Events\AdminNotification;
use App\Http\Controllers\BaseAdminController;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Pusher\Pusher;
class HomeController extends Controller
{
    public function index() {
        $notification = Notification::select('notifications.id', 'users.name' , 'message')
            ->join('users' , 'users.id' , '=' , 'notifications.user_id')
            ->get();
        return view('admin.dashboard.dashboard' , compact('notification'));
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

        $data = ['message' => 'Đây là thông báo mất kỳ.'];

        // Gửi thông báo đến kênh riêng của người dùng
        $pusher->trigger("private-user-$userId", 'notification-event', $data);
        Notification::create([
            'user_id' => $userId,
            'message' => $data['message'],
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }

    public function getNotification()
    {
        $notifications = Notification::where('user_id', auth()->id())->get();

        return response()->json(['notifications' => $notifications]);
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

        $data = ['message' => $message];

        $pusher->trigger("my-event", 'notification-event', $data);
        event(new AdminNotification($message));
        return response()->json(
            ['msg' => 'đã gửi thông báo thành công']
        , 200);
    }
}
