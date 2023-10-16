<?php
namespace App\Services;

use App\Interfaces\MessageUser;
use App\Models\Notification;
use Pusher\Pusher;

class MessageService implements MessageUser {

    public function sendMessage($userId, $message)
    {
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);

        $pusher->trigger("user-notification-3", 'notification-event-test', $message);
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }

    public function sendMessageDoctor($doctor_id, $message)
    {
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);

        $pusher->trigger("doctor-notification-".$doctor_id, 'notification-event-test', $message);
        Notification::create([
            'doctor_id' => $doctor_id,
            'message' => $message,
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }
}
