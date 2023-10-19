<?php
namespace App\Services;

use App\Interfaces\MessageUser;
use App\Models\Notification;
use App\Traits\QueryCommon;
use Pusher\Pusher;

class MessageService implements MessageUser {

    use QueryCommon;
    public function sendMessage($userId ='', $message='' , $doctor_id='' , $message_doctor = '')
    {
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);
        $dataMessage = $this->tableQuery('users')->where('id' , $userId)->first();
        $messagess = [
            'name' => $dataMessage->name,
            'avatar' => $dataMessage->avatar,
            'id' => $dataMessage->id,
            'message' => $message
        ];
        $dataMessageDoctor = $this->tableQuery('doctors')->where('id' , $doctor_id)->first();
        $message_doctors = [
            'name' => $dataMessageDoctor->name,
            'avatar' => $dataMessageDoctor->image,
            'id' => $dataMessageDoctor->id,
            'message' => $message_doctor
        ];
        $pusher->trigger("user-notification-".$userId, 'notification-event-test', $messagess );
        $pusher->trigger("doctor-notification-".$doctor_id, 'notification-event-doctor', $message_doctors);
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
            'doctor_id' => $doctor_id,
            'message_doctor' => $message_doctor
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }
}
