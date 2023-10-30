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
            'message_doctor' => $message_doctor,
            'read_user' => 0
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }

    public function sendManyUser($userId ='', $message='') {

        $dataMessage = $this->tableQuery('users')->where('id' , $userId)->first();
        $messagess = [
            'name' => $dataMessage->name,
            'avatar' => $dataMessage->avatar,
            'id' => $dataMessage->id,
            'message' => $message
        ];

        $this->pusherWeb()->trigger("user-notification-".$userId, 'notification-event-test', $messagess );
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }

    public function sendManyDoctor($doctor_id, $message_doctor)
    {
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);
        $dataMessageDoctor = $this->tableQuery('doctors')->where('id' , $doctor_id)->first();
        $message_doctors = [
            'name' => $dataMessageDoctor->name,
            'avatar' => $dataMessageDoctor->image,
            'id' => $dataMessageDoctor->id,
            'message' => $message_doctor
        ];
        $pusher->trigger("doctor-notification-".$doctor_id, 'notification-event-doctor', $message_doctors );
        Notification::create([
            'doctor_id' => $doctor_id,
            'message_doctor' => $message_doctor,
        ]);
        return response()->json(['message' => 'Thông báo đã được gửi']);
    }
    public function sendDoctorToAdmin($doctor_id, $message_doctor, $roleId, $message)
    {
        $pusher = new Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), [
            'cluster' => config('broadcasting.connections.pusher.options.cluster'),
            'useTLS' => config('broadcasting.connections.pusher.options.useTLS'),
        ]);

        $dataMessageDoctor = $this->tableQuery('doctors')->where('id', $doctor_id)->first();
        $message_doctors = [
            'name' => $dataMessageDoctor->name,
            'avatar' => $dataMessageDoctor->image,
            'id' => $dataMessageDoctor->id,
            'message' => $message_doctor
        ];

        $users = $this->tableQuery('users')->where('role_id', $roleId)->get();

        foreach ($users as $user) {
            $messagess = [
                'name' => $user->name,
                'avatar' => $user->avatar,
                'role_id' => $user->role_id,
                'message' => $message
            ];
            $pusher->trigger("user-notification-" . $user->id, 'notification-event-test', $messagess);
            Notification::create([
                'user_id' => $user->id,
                'message' => $message,
                'doctor_id' => $doctor_id,
                'message_doctor' => $message_doctor
            ]);
        }

        $pusher->trigger("doctor-notification-" . $doctor_id, 'notification-event-doctor', $message_doctors);

        return response()->json(['message' => 'Thông báo đã được gửi đến tất cả người dùng có role_id là ' . $roleId]);
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
