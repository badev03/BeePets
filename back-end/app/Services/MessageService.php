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

        $pusher->trigger("user-notification-3", 'notification-event', $message);
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }
}
