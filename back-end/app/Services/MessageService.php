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
        $this->pusherWeb()->trigger("user-notification-".$userId, 'notification-event-test', $messagess );
        $this->pusherWeb()->trigger("doctor-notification-".$doctor_id, 'notification-event-doctor', $message_doctors);
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
            'doctor_id' => $doctor_id,
            'message_doctor' => $message_doctor
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }

    public function sendManyUser($userId ='', $message='') {
        $this->pusherWeb()->trigger("user-notification-".$userId, 'notification-event-test', $message );
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }

    public function sendManyDoctor($doctor_id, $message_doctor)
    {
        $this->pusherWeb()->trigger("doctor-notification-".$doctor_id, 'notification-event-test', $message_doctor );
        Notification::create([
            'doctor_id' => $doctor_id,
            'message_doctor' => $message_doctor,
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }

        public function pusherWeb()
    {
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);
        return $pusher;
    }
}
